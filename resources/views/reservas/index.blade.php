@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Reservas</h1>

    @if(session('ok'))
        <div class="alert alert-success">{{ session('ok') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisá los campos:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- Crear nueva --}}
    <div class="card mb-4">
        <div class="card-header">Crear reserva</div>
        <div class="card-body">
            <form method="POST" action="{{ route('reservas.store') }}" class="row g-3">
                @csrf

                <div class="col-md-4">
                    <label class="form-label">Materia</label>
                    <select name="materia_id" class="form-select" required>
                        <option value="">— Elegir —</option>
                        @foreach ($materias as $m)
                            <option value="{{ $m->id }}" @selected(old('materia_id')==$m->id)>{{ $m->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Día</label>
                    <select name="dia" class="form-select" required>
                        @foreach ($dias as $d)
                            <option value="{{ $d }}" @selected(old('dia')==$d)>{{ ucfirst($d) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Hora inicio</label>
                    <input type="time" name="hora_inicio" class="form-control" step="1200" value="{{ old('hora_inicio') }}" required>
                    <div class="form-text">Minutos: 00, 20 o 40</div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Hora fin</label>
                    <input type="time" name="hora_fin" class="form-control" step="1200" value="{{ old('hora_fin') }}" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tipo origen</label>
                    <select name="tipo_origen" class="form-select" required>
                        @foreach ($tipos as $k=>$v)
                            <option value="{{ $k }}" @selected(old('tipo_origen')==$k)>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla y edición inline --}}
    <div class="card">
        <div class="card-header">Listado</div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservas as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->materia->nombre ?? '—' }}</td>
                            <td>{{ ucfirst($r->dia) }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($r->hora_inicio)->format('H:i') }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($r->hora_fin)->format('H:i') }}</td>
                            <td>{{ ucfirst($r->tipo_origen) }}</td>
                            <td>{{ $r->user->name ?? '—' }}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#edit-{{ $r->id }}">
                                    Editar
                                </button>

                                <form action="{{ route('reservas.destroy', $r) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar reserva #{{ $r->id }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Borrar</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="collapse" id="edit-{{ $r->id }}">
                            <td colspan="8">
                                <form method="POST" action="{{ route('reservas.update', $r) }}" class="row g-3 p-3 border-top">
                                    @csrf @method('PUT')

                                    <div class="col-md-4">
                                        <label class="form-label">Materia</label>
                                        <select name="materia_id" class="form-select" required>
                                            @foreach ($materias as $m)
                                                <option value="{{ $m->id }}" @selected($r->materia_id==$m->id)>{{ $m->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Día</label>
                                        <select name="dia" class="form-select" required>
                                            @foreach ($dias as $d)
                                                <option value="{{ $d }}" @selected($r->dia==$d)>{{ ucfirst($d) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Inicio</label>
                                        <input type="time" name="hora_inicio" class="form-control" step="1200"
                                               value="{{ \Illuminate\Support\Carbon::parse($r->hora_inicio)->format('H:i') }}" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Fin</label>
                                        <input type="time" name="hora_fin" class="form-control" step="1200"
                                               value="{{ \Illuminate\Support\Carbon::parse($r->hora_fin)->format('H:i') }}" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Tipo origen</label>
                                        <select name="tipo_origen" class="form-select" required>
                                            @foreach ($tipos as $k=>$v)
                                                <option value="{{ $k }}" @selected($r->tipo_origen==$k)>{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary">Actualizar</button>
                                        <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $r->id }}">Cancelar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center p-4">Sin reservas aún.</td></tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
        @if($reservas->hasPages())
            <div class="card-footer">{{ $reservas->links() }}</div>
        @endif
    </div>
</div>
@endsection

