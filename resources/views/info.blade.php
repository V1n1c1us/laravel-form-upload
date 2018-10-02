<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                <div class="card-header text-center">
                    {{ $produto->nome }}
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="rounded" src="\storage\foto_produto\{{ $produto->image }}" alt="Card image cap">
                    </div>
                    <h5 class="card-title">{{ $produto->nome }}</h5>
                    <p class="card-text">{{ $produto->descricao}}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
