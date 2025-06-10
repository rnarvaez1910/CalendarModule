@extends('admin.layouts.layout')

@section('styles')
    <!-- Sweet alert 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/portalunimar/other/select2-boostrap.css') }}">
    <!-- Page custom styles -->
    <link rel="stylesheet" href="{{ asset('css/portalunimar/admin/profile.css') }}">
@endsection

@section('scripts')
    <!-- Sweet alert 2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('plugins/select2/js/select2.js') }}" defer></script>
    <!-- Page custom scripts -->
    <script src="{{ asset('js/portalunimar/admin/profile.js') }}" defer></script>
@endsection

@section ('admincontent')
    <!-- Page heading -->
    <div class="h3 mb-0 text-gray-dark"><h3>Perfil del usuario</h3></div>
    <!-- /.page-heading -->

    <div class="flex-content justify-content-lg-around flex-fill">
        <!-- Success message for registry -->
        <x-registry-status/>

        <div class="row">
            <!-- Account details card-->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">Detalles de cuenta</div>
                    <div class="card-body">
                        <form action="#" method="POST" id="formprofile">
                            @csrf
                            <!-- Just info data -->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Nombre</label>
                                    <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Documento de identidad</label>
                                    <input class="form-control" type="text" value="{{ $user->document_id }}" readonly>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Nombre de la Organización</label>
                                    <input class="form-control" type="text" value="Unimar" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Ubicación</label>
                                    <input class="form-control" type="text" value="El Valle del Espíritu Santo" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">Correo institucional</label>
                                <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                            </div>
                            <!-- /.just-info-data -->

                            <!-- Updatable data -->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Número de teléfono</label>
                                    <input class="form-control" id="inputPhone" placeholder="Introduzca su número de teléfono personal" type="tel" minlength="10" maxlength="30" name="phone" value="{{ old('phone') ?? $user->phone }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Fecha de nacimiento</label>
                                    <input class="form-control" id="inputBirthday" placeholder="Introduzca su fecha de nacimiento" type="date" name="birth" value="{{ old('birth') ?? $user->birth }}" required>
                                </div>
                            </div>
                            <!-- /.updatable-data -->
                            <button class="btn btn-primary" type="Submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.account-details-card -->
            
            <!-- Password change card-->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">Actualizar Contraseña</div>
                    <div class="card-body">
                        <form action="#" method="POST" id="formprofile">
                            @csrf
                            <div class="row gx-3 mb-3">
                                <div class="col-12">
                                    <label class="small mb-1" for="current_password">Contraseña actual</label>
                                    <input class="form-control" id="current_password" placeholder="Introduzca su contraseña actual" type="password" minlength="8" maxlength="255" name="current_password" value="{{ old('current_password') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="small mb-1" for="new_password">Contraseña nueva</label>
                                    <input class="form-control" id="new_password" placeholder="Introduzca su nueva contraseña" type="password" minlength="8" maxlength="255" name="new_password" value="{{ old('new_password') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="small mb-1" for="confirm_password">Confirmar contraseña</label>
                                    <input class="form-control" id="confirm_password" placeholder="Confirme su nueva contraseña" type="password" minlength="8" maxlength="255" name="confirm_password" value="{{ old('confirm_password') }}" required>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="Submit">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.pasword-change-card -->
        </div>
    </div>
@endsection
