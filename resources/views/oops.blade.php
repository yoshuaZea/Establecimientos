<!DOCTYPE html>
<html lang = es>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<meta http-equiv="X-UA-Compatible" content="id=edge">
		<!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Icon -->
        <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">

    	<title id="title-page">Oops...</title>
    </head>
    <body class="d-flex flex-column justify-content-center min-vh-100">
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-7">
                    <h1 class="text-primary">{{ env('APP_NAME') }}</h1>
                    <h3 class="text-secondary">Oops... Hubo un problema con tu petición. <i class="far fa-frown-open"></i></h3>
                    <p class="text-secondary">
                        <?php echo $msg?>
                    </p>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-primary" onClick="window.history.back()">Volver a la aplicación</button>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
