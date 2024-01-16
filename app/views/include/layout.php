<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/styles.css">

    <title>
        <?= $title ?>
    </title>
</head>

<body class="text-dark">
    <?php require_once 'navbar.php' ?>
    <?= $content ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js">
    </script>
    <!-- TinyMCE  -->
    <script src="https://cdn.tiny.cloud/1/ik9il8zo8q256z447zflqdlsgao23upmw0je0y40jcrt76df/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        const fetchApi = import("https://unpkg.com/@microsoft/fetch-event-source@2.0.1/lib/esm/index.js").then(module =>
            module.fetchEventSource);
        const api_key = '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';

        tinymce.init({
            selector: 'textarea',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],

            // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            //     "I need api for chat gpt to work but im poor to have one")),
            ai_request: (request, respondWith) => {
                respondWith.stream((signal, streamMessage) => {
                    // Adds each previous query and response as individual messages
                    const conversation = request.thread.flatMap((event) => {
                        if (event.response) {
                            return [{
                                    role: 'user',
                                    content: event.request.query
                                },
                                {
                                    role: 'assistant',
                                    content: event.response.data
                                }
                            ];
                        } else {
                            return [];
                        }
                    });

                    // System messages provided by the plugin to format the output as HTML content.
                    const pluginSystemMessages = request.system.map((content) => ({
                        role: 'system',
                        content
                    }));

                    const systemMessages = [
                        ...pluginSystemMessages,
                        // Additional system messages to control the output of the AI
                        {
                            role: 'system',
                            content: 'Remove lines with ``` from the response start and response end.'
                        }
                    ]

                    // Forms the new query sent to the API
                    const content = request.context.length === 0 || conversation.length > 0 ?
                        request.query :
                        `Question: ${request.query} Context: """${request.context}"""`;

                    const messages = [
                        ...conversation,
                        ...systemMessages,
                        {
                            role: 'user',
                            content
                        }
                    ];

                    const requestBody = {
                        model: 'gpt-3.5-turbo',
                        temperature: 0.7,
                        max_tokens: 800,
                        messages,
                        stream: true
                    };

                    const openAiOptions = {
                        signal,
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${api_key}`
                        },
                        body: JSON.stringify(requestBody)
                    };

                    const onopen = async (response) => {
                        if (response) {
                            const contentType = response.headers.get('content-type');
                            if (response.ok && contentType?.includes('text/event-stream')) {
                                return;
                            } else if (contentType?.includes('application/json')) {
                                const data = await response.json();
                                if (data.error) {
                                    throw new Error(
                                        `${data.error.type}: ${data.error.message}`);
                                }
                            }
                        } else {
                            throw new Error('Failed to communicate with the ChatGPT API');
                        }
                    };

                    // This function passes each new message into the plugin via the `streamMessage` callback.
                    const onmessage = (ev) => {
                        const data = ev.data;
                        if (data !== '[DONE]') {
                            const parsedData = JSON.parse(data);
                            const firstChoice = parsedData?.choices[0];
                            const message = firstChoice?.delta?.content;
                            if (message) {
                                streamMessage(message);
                            }
                        }
                    };

                    const onerror = (error) => {
                        // Stop operation and do not retry by the fetch-event-source
                        throw error;
                    };

                    // Use microsoft's fetch-event-source library to work around the 2000 character limit
                    // of the browser `EventSource` API, which requires query strings
                    return fetchApi
                        .then(fetchEventSource =>
                            fetchEventSource('https://api.openai.com/v1/chat/completions', {
                                ...openAiOptions,
                                openWhenHidden: true,
                                onopen,
                                onmessage,
                                onerror
                            })
                        )
                        .then(async (response) => {
                            if (response && !response.ok) {
                                const data = await response.json();
                                if (data.error) {
                                    throw new Error(
                                        `${data.error.type}: ${data.error.message}`);
                                }
                            }
                        })
                        .catch(onerror);
                });
            }
        });
    </script>
</body>

</html>