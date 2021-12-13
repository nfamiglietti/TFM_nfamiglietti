<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
<table class="table table-striped table-hover table-reflow">
    <thead>
        <tr>
            <th>cabecera grade</th>
            <th>cabecera state</th>
            <th>cabecera url</th>
        </tr>
    </thead>
    <tbody>
    @foreach($array as $key=>$value)
    <tr>
        <td>  {{ $value["grade"] }} </td>
        <td>  {{ $value["state"] }} </td>
        <td>  {{ $value["url"]}} </td>
    </tr>
        @endforeach
    </tbody>
        
    </table>
    
</div>