@extends('layouts.adminlayout')

@section('pagecontent')
    <div class="page-title">
        <div class="title_left">
            <h3>Lista de usuarios</h3>
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
                    <a href="{{ route('admin.users.download') }}" class="btn btn-info btn-sm pull-right"><i
                                class="fa fa-download"></i> Descargar todos</a>

                    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm pull-right"><i
                                class="fa fa-plus"></i> Agregar nuevo usuario</a>

                </div>
                <div id="msgContainer"></div>
                <div class="x_content">
                    <table id="dataListing" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->type == 2 ? "Doctor" : $user->type == 3 ? "Clínica": "Visitante"}}</td>
                                <td>
                                    <div class="statusBtn{{$user->id}}">
                                        <a href="javascript:void(0);"
                                           onclick="changeStatus('{{$user->id}}','{{!$user->status}}')"
                                           class="btn {{$user->status ? "btn-success" : "btn-danger"}} btn-sm btn-status"
                                           title="Click here to make it inactive">
                                            {{$user->status ? "Active": "Inactive"}}
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{route('user.edit', $user->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" title="Click to delete"
                                            onclick="deleteUser('{{$user->id}}','{{route("user.destroy", $user->id)}}')">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <a class="btn btn-info btn-sm" target="_blank"
                                       href="{{route("user.profiledetails", $user->userslug)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
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

        function changeStatus(id, newstatus) {
            if (!confirm('Are you sure you want to chage the status?')) {
                return false;
            }
            $.ajax({
                url: '{{ route('changeStatus') }}',
                type: 'post',
                data: {id: id, newstatus: newstatus, _token: '{{csrf_token()}}'},
                success: function (data) {
                    if (newstatus == 0) {
                        $('div.statusBtn' + id).html('<a href="javascript:void(0);" onclick="changeStatus(' + id + ', 1)" class="btn btn-sm btn-danger" title="Click here to make it active">Inactive</a>');
                    } else {
                        $('div.statusBtn' + id).html('<a href="javascript:void(0);" onclick="changeStatus(' + id + ', 0)" class="btn btn-sm btn-success" title="Click here to make it inactive">Active</a>');

                    }
                    $('#msgContainer').show().html('<div class="alert alert-success">Option status have been updated successfully!!</div>').fadeOut(5000);
                },
                error: function (data, textStatus, errorThrown) {
                    alert('Error Occurred');
                },
            })
        }

        function deleteUser(userid, url) {
            if (!confirm('¿Seguro que desea eliminar este usuario?')) {
                return false;
            }
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "id": userid,
                    "_method": 'DELETE',
                    "_token": '{{csrf_token()}}'
                },
                success: function (data) {
                    location.reload();
                },
                error: function (data, textStatus, errorThrown) {
                    alert('Error Occurred');
                }
            });
        }
    </script>
@endsection