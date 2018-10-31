@extends('layouts.adminlayout')

@section('pagecontent')
    <div class="page-title">
        <div class="title_left">
            <h3>Lista de Contactos</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    @if(session()->has('message.level'))
        <div class="horizontal-center alert alert-{{ session('message.level') }}">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! session('message.content') !!}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="">
                    <div class="clearfix"></div>
                </div>
                <div id="msgContainer"></div>
                <div class="x_content">
                    <table id="dataListing" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Correo Electrónico</th>
                            <th>Comentarios</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contactos as $contacto)
                            <tr>
                                <td>{{$contacto->fullname}}</td>
                                <td>{{$contacto->email}}</td>
                                <td>{{$contacto->comments}}</td>
                                <td>{{$contacto->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        var dataTable;
        $(document).ready(function () {
            dataTable = $("#dataListing").DataTable();
        });
    </script>
@endsection