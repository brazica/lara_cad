@extends( 'layout.app', ["current" => "games"] )

@section( 'body' )

<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Jogos </h5>
        <table class="table table-ordered table-hover" id="tableGames">
            <thead>
              <tr>
                <th>Código </th>
                <th>Pwd </th>
                <th>Nome </th>
                <th>Online </th>
                <th>Tempo </th>
                <th>Indicações </th>
                <th>Comentários </th>
                <th>Plataforma </th>
                <th>Ações </th>
            </tr>
          </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="newGame()">Novo Jogo </a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgGame">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" id="formGame">
        <div class="modal-header">
            <h5 class="modal-title">Novo Jogo </h5>
        </div>
        <div class="modal-body">

          <input type="hidden" id="id" class="form-control">
          <div class="form-group">
              <label for="pwdGame" class="control-label">Pwd </label>
              <div class="input-group">
                <input type="text" class="form-control" id="pwdGame" placeholder="pwd">
            </div>
          </div>
          <div class="form-group">
              <label for="nameGame" class="control-label">Nome do Jogo </label>
              <div class="input-group">
                <input type="text" class="form-control" id="nameGame" placeholder="Nome do Jogo">
            </div>
          </div>
          <div class="form-group">
            <label for="onlineGame" class="control-label">Online </label>
            <div class="input-group">
                <input type="text" class="form-control" id="onlineGame" placeholder="Online">
            </div>
          </div>
          <div class="form-group">
            <label for="timeGame" class="control-label">Tempo </label>
            <div class="input-group">
                <input type="number" class="form-control" id="timeGame" placeholder="Tempo">
          </div>
        </div>
          <div class="form-group">
            <label for="indicationGame" class="control-label">Indicações </label>
            <div class="input-group">
                <input type="text" class="form-control" id="indicationGame" placeholder="Indicações ">
            </div>
          </div>
          <div class="form-group">
            <label for="commentsGame" class="control-label">Comentários </label>
            <div class="input-group">
                <input type="text" class="form-control" id="commentsGame" placeholder="Comentários">
            </div>
          </div>
          <div class="form-group">
            <label for="plataformGame" class="control-label">Plataforma </label>
            <div class="input-group">
              <select class="form-control" id="plataformGame">
              </select>
            </div>
          </div>
        <div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar </button>
            <button type="cancel" class="btn btn-secundary" data-dismiss="modal">Cancelar </button>
    </form>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      function newGame() {
          $("#id").val( '' );
          $("#pwdGame").val('');
          $("#nameGame").val('');
          $("#onlineGame").val('');
          $("#timeGame").val('');
          $("#indicationGame").val('');
          $("#commentsGame").val('');
          $("#dlgGame").modal('show');
      }

      function loadPlataform() {
        $.getJSON('/api/plataform', function(data) {
          for (i = 0; i < data.length; i++) {
              opcao = '<option value ="' + data[i].id + '">' +
                  data[i].name + '</option>';
                  $("#plataformGame").append(opcao);
                }
              });
            }

      function moutLine(p) {
        var line = "<tr>" +
          "<td>" + p.id + "</td>" +
          "<td>" + p.pwd + "</td>" +
          "<td>" + p.name + "</td>" +
          "<td>" + p.online + "</td>" +
          "<td>" + p.time + "</td>" +
          "<td>" + p.indication + "</td>" +
          "<td>" + p.comments + "</td>" +
          "<td>" + p.plataform_id + "</td>" +
          "<td>" +
              '<button class="btn btn-sm btn-primary" onClick="edit(' + p.id + ')"> Editar </button> ' +
              '<button class="btn btn-sm btn-danger" onClick="remove(' + p.id + ')"> Apagar </button> ' +
          "<td>" +
          "</tr>";
        return line;
      }

      function edit(id) {
        $.getJSON('/api/games/'+id, function( data ) {
            console.log(data);
            $("#id").val(data.id);
            $("#pwdGame").val(data.pwd);
            $("#nameGame").val(data.name);
            $("#onlineGame").val(data.online);
            $("#timeGame").val(data.time);
            $("#indicationGame").val(data.indication);
            $("#commentsGame").val(data.comments);
            $("#plataformGame").val(data.plataform_id);
            $("#dlgGame").modal('show');
          });
        }

      function remove(id) {
          $.ajax({
            type: "DELETE",
            url: '/api/games/' + id,
            context: this,
            success: function() {
                console.log("Apagou OK!");
                linhas = $("#tableGames>tbody>tr");
                e = linhas.filter(function(i, e) {
                    return e.cells[0].textContent == id;
                });
                if (e)
                  e.remove();
          },
          error: function(error) {
            console.log(error);
          }
        });
      }

      function loadGames() {
          $.getJSON('/api/games', function(games) {
              for(i = 0; i < games.length; i++ ) {
                  line = moutLine(games[i]);
                  $("#tableGames>tbody").append(line);
              }
            });
          }

      function createGame() {
          game =  {
                pwd: $("#pwdGame").val(),
                name: $("#nameGame").val(),
                online: $("#onlineGame").val(),
                time: $("#timeGame").val(),
                indication: $("#indicationGame").val(),
                comments: $("#commentsGame").val(),
                plataform_id: $("#plataformGame").val()
            }
            $.post('/api/games', game, function(data) {
                games = JSON.parse(data);
                line = moutLine(games);
                $("#tableGames>tbody").append(line);
            });
        };

      function saveGame() {
        game = {
            id: $("#id").val(),
            pwd: $("#pwdGame").val(),
            name: $("#nameGame").val(),
            online: $("#onlineGame").val(),
            time: $("#timeGame").val(),
            indication: $("#indicationGame").val(),
            comments: $("#commentsGame").val(),
            plataform_id: $("#plataformGame").val()
          };
          $.ajax({
            type: "PUT",
            url: '/api/games/' + game.id,
            context: this,
            data: game,
            success: function(data) {
              linhas = $("#tableGames>tbody>tr");
              e = linhas.filter(function(i, e) {
                  return e.cells[0].textContent == game.id;
              });
              if (e) {
                e[0].cells[0].textContent = game.id;
                e[0].cells[1].textContent = game.pwd;
                e[0].cells[2].textContent = game.name;
                e[0].cells[3].textContent = game.online;
                e[0].cells[4].textContent = game.time;
                e[0].cells[5].textContent = game.indication;
                e[0].cells[6].textContent = game.comments;
                e[0].cells[7].textContent = game.plataform_id;
              }

              },
              error: function(error) {
                console.log(error);
              }
            });
        }

      $("#formGame").submit(function(event) {
            event.preventDefault();
            if ($("#id").val() !='' )
            saveGame();
            else
              createGame();
            $("#dlgGame").modal('hide');
        });

         $(function() {
            loadPlataform();
            loadGames();
      });

</script>
@endsection
