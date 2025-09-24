<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</title>
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Panel Admin</div>
            </a>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('user')['firstName'] ?? 'Usuario' }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>
                    @include('templates.messages')

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ isset($user) ? 'Editar Usuario' : 'Nuevo Usuario' }}</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($user) ? route('users.update', $user['id']) : route('users.store') }}" method="POST">
                                @csrf
                                @if(isset($user))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">Nombre</label>
                                        <input type="text" class="form-control" name="firstName"
                                            value="{{ old('firstName', $user['firstName'] ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">Apellido</label>
                                        <input type="text" class="form-control" name="lastName"
                                            value="{{ old('lastName', $user['lastName'] ?? '') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username">Usuario</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ old('username', $user['username'] ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Correo</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email', $user['email'] ?? '') }}" required>
                                    </div>
                                </div>

                                @if(!isset($user))
                                <div class="mb-3">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="age">Edad</label>
                                        <input type="number" class="form-control" name="age"
                                            value="{{ old('age', $user['age'] ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="phone">Teléfono</label>
                                        <input type="tel" class="form-control" name="phone"
                                            value="{{ old('phone', $user['phone'] ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="gender">Género</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="">Seleccione...</option>
                                            <option value="male" {{ old('gender', $user['gender'] ?? '') == 'male' ? 'selected' : '' }}>Masculino</option>
                                            <option value="female" {{ old('gender', $user['gender'] ?? '') == 'female' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ isset($user) ? 'Actualizar' : 'Guardar' }}
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>