<?php $page = 'Tunjangan Pegawai' ?>
<?php $root = 'tunjangan_pegawai' ?>

<?php 
if (!isset($field_old)) {
     $field_old = '';
 } ?>

@section('search')
<form action="{{url($root)}}" method="get">
    <div class="input-group">
        <div class="input-group-btn">
            <select class="form-control" name="field">
                @foreach($fields as $field)
                <option value="{{$field}}" <?php if ($field==$field_old) {echo "selected";} ?>>{{$field}}</option>
                @endforeach
            </select>
        </div>
        <input class="form-control" id="appendbutton" type="text" name="search" value="<?php if (isset($search)) {echo($search);} ?>">
        <div class="input-group-btn">
            <button class="btn btn-primary" type="submit">
                Search
            </button>
            <a href="{{url($root)}}" class="btn btn-danger">
                Cancle
            </a>
        </div>
    </div>
</form>
@endsection

@section('footer')
<a href="{{url($root)}}">{{$page}}</a>
@endsection

@extends('layouts.'.config('app.layout'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>
                <div class="panel-body" align="center">
                	<table class="table table-hover">
                        @if(isset($datas->first()->id))
                        <thead>
                		<tr>
                            <th>Kode</th>
                            <th>Pegawai</th>
                			<th colspan="3">Action</th>
                		</tr>
                        </thead>
                        <tbody>
                		@foreach ($datas as $data)
                		<tr>
                            <td>{{$data->tunjangan->kode_tunjangan}}</td>
                            <td>{{$data->pegawai->nip}}</td>
                			<td class="action-web"><a href="{{url($root,$data->id)}}" class="btn btn-default">View</a></td>
                            <td class="action-web"></td>
                            <td class="action-web">{!! Form::open(['method'=> 'DELETE', 'route'=>[$root.'.destroy',$data->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger lebar']) !!}
                            {!! Form::close() !!}</td>
                            <td class="action-mobile dropdown" colspan="3">
                                <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Action <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{url($root,$data->id)}}">View</a></li>
                                    <li><a href="{{route('tunjangan.edit',$data->id)}}">Edit</a></li>
                                </ul>
                            </td>
                		</tr>
                		@endforeach
                        </tbody>
                        @else
                        <thead>
                            <tr>
                                <td><h1>Not Found</h1></td>
                            </tr>
                        </thead>
                        @endif
                	</table>
                    {{$datas->links()}}
                </div>
            </div>
        </div>
        @include('layouts.sidebar')
    </div>
</div>
@include('layouts.footer')
@endsection
