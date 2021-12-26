<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta charset="utf-8">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <!-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>TFMv3</title>

    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-left: 20%">
                <div class="input-field col s6">
                    <i class="material-icons prefix">cloud_queue</i>
                    <input id="inUrl" type="text" value="">
                    <label for="inUrl">Insert URL</label>
                </div>    
                <button class="btn waves-effect waves-light btn-small" style="margin-top: 2%" type="submit" id="myajax" name="myajax">Send
                    <i class="material-icons right">send</i>
                </button>
            </div>
            <div>
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <table class="centered responsive-table striped table_url_inspect" >
                        <thead>
                            <tr>
                                <th>API</th>
                                <th>Url</th>
                                <th>State</th>
                                <th>More Info.</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" ></script>
    </body>
</html>
<script>
    function nl2br(str, replaceMode, isXhtml){
        var breakTag = (isXhtml) ? '<br />' : '<br>';
        var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
    }
    $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         $('#myajax').click(function(){
            //we will send data and recive data fom our AjaxController
            $.ajax({
               url:'/miJqueryAjax',
               data:{'inUrl':$("#inUrl").val()},
               type:'post',
               success:  function (response) {
                  if(response != undefined && response != null && response.length > 0){
                    let rows = '';
                    response.forEach(element => {
                        rows +=`<tr>
                                    <td>`+element['api']+`</td>
                                    <td>`+element['url']+`</td>
                                    <td>`+element['grade']+`</td>
                                    <td>`+nl2br(element['state'])+`</td>
                                </tr>`
                      });
                    $(".table_url_inspect tbody").append(rows);
                  }
                  else {
                    console.log('not response');
                  }
               },
               statusCode: {
                  404: function() {
                     alert('web not found');
                  }
               },
               error:function(x,xs,xt){
                  console.log('Error !!');
                  console.log(x["responseText"]);
               }
            });
        });
</script>