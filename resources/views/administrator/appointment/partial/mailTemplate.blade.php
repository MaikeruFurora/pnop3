<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sent Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body shadow text-center">
                    {{-- <img src="https://raw.githubusercontent.com/MaikeruFurora/sialevelup/main/public/img/logos.png"
                        width="18%"> --}}
                    <h1 class="lead mt-4">
                        {{ $data['title'] }}
                    </h1>
                    <p class="mt-3">
                        @php echo html_entity_decode($data['body']) @endphp
                        {{-- {{ $data['body'] }} --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>