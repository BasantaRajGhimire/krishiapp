<table class="table table-striped items-table">
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Number</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $i=>$item)
        <tr>
            <input type="hidden" class="item-id" value="{{$item->id}}">
            <td>{{$i+1}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->number}}</td>
            <td><i class="delete-item btn btn-xs btn-danger delete-item fa fa-times"></i></td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>

</script>