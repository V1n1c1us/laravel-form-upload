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
                <form method="POST" enctype="multipart/form-data">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nome" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descricao"></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    <div class="mx-auto" style="width: 100px; margin-top:30px;">
                        <button class="btn btn-primary" type="submit"/><i class="fas fa-plus-circle fa-2x"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            @forelse ($produtos as $produto)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="\storage\foto_produto_thumb\{{ $produto->image }}" alt="Card image cap" height="250">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                    <p class="card-text"> {{ $produto->descricao }}</p>
                    </div>
                    <div class="card-body mx-auto">
                        <a href="/info/{{ $produto->id }}" class="card-link"><i class="fas fa-info"></i></a>
                        <a href="/update/{{ $produto->id }}" class="card-link"><i class="fas fa-edit"></i></a>
                        <a href="/delete/{{ $produto->id }}" class="card-link"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="alert alert-warning text-center" role="alert">
                    Nenhum produto cadastrado ({{ $produtos->count()}}) <b>Insira um registro. </b>
                </div>
            </div>
            @endforelse
        </div>
        {!! $produtos->links() !!}
    </div>
</body>
</html>
