<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $docente->nombre_completo }}</h5>
        <p class="card-text">
            <strong>Especialidad:</strong> {{ $docente->especialidad }}<br>
            <strong>Registrado por:</strong> {{ $docente->creador->name }}<br>
            <strong>Fecha creación:</strong> {{ $docente->created_at->format('d/m/Y') }}
        </p>
    </div>
</div>
