@extends('layouts.master')

@section('content')
    <form id="densidadePalavrasChavesForm">
        <div class="form-group">
            <label for="densidadePalavrasChaves">
                Escreva HTML ou Texto
            </label>
            <textarea name="" id="palavrasChavesInput" cols="30" rows="12" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2">
            Veja a quantidade de palavras chave
        </button>
    </form>
@endsection

@section('scripts')
    <script> 
        $('#densidadePalavrasChavesForm').on('submit', function (e) {
            e.preventDefault();
            let palavraChaveInput = $('#palavrasChavesInput').val();
            $("#densidadePalavrasChavesForm").after(palavraChaveInput);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrfToken"]').attr('content'),
                }
            });

            $.ajax({
                type: 'POST',
                url: "/tool/calcular-e-devolver-densidade",
                data: {"palavraChaveInput": palavraChaveInput},
                success: function (retorno){
                    if (retorno.length > 0) {
                        $("#densidadePalavrasChavesForm").after("<H1>AGORA DEU BAUM</H1>" + retorno[1].palavraChave);
                        let html = "<table class='table'><tbody><thead>";
                            html += "<th>Palavras Chaves</th>";
                            html += "<th>Contagem</th>";
                            html += "<th>Porcentagem</th>";
                            html += "</thead>";

                        for(let i = 0; i < retorno.length; i++){
                            html += "<tr><td>"+retorno[i].palavraChave+"</td>";
                            html += "<td>"+retorno[i].count+"</td>";
                            html += "<td>"+retorno[i].densidade+"%</td></tr>";
                        }

                        html += "</tbody></table>";

                        $("#densidadePalavrasChavesForm").after(html);
                        
                    } else{
                        $("#densidadePalavrasChavesForm").after(retorno.length);
                    }
                }
                
            })

        });
    </script>
@endsection