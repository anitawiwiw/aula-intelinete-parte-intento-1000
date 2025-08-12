<!DOCTYPE html>
<html>
<head>
    <title>Crear Reserva</title>
    <script>
        function validateForm() {
            const form = document.forms[0];
            const submitBtn = form.querySelector('button[type="submit"]');
            let isValid = true;

            // Validar campos vacíos
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value) {
                    isValid = false;
                }
            });

            // Validar año
            const fechaInput = form.querySelector('#fecha');
            if (fechaInput.value) {
                const year = new Date(fechaInput.value).getFullYear();
                if (year < 2025 || year > 2030) {
                    isValid = false;
                }
            }

            // Validar horarios
            const horaInicio = form.querySelector('#hora_inicio').value;
            const horaFin = form.querySelector('#hora_fin').value;
            if (horaInicio && horaFin) {
                const inicioHour = parseInt(horaInicio.split(':')[0]);
                const finHour = parseInt(horaFin.split(':')[0]);
                
                if (inicioHour < 7 || inicioHour >= 22 || 
                    finHour < 7 || finHour > 22) {
                    isValid = false;
                }
            }

            submitBtn.disabled = !isValid;
        }

        // Validar en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.forms[0];
            form.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('input', validateForm);
                element.addEventListener('change', validateForm);
            });
            validateForm(); // Validación inicial
        });
    </script>
</head>
<body>
    <h1>Crear Nueva Reserva</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('reservas.store') }}">
        @csrf
        
        <div>
            <label for="fecha">Fecha (2025-2030):</label>
            <input type="date" id="fecha" name="fecha" required 
                   min="2025-01-01" max="2030-12-31">
        </div>

        <div>
            <label for="hora_inicio">Hora de Inicio (7:00-22:00):</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required
                   min="07:00" max="22:00">
        </div>

        <div>
            <label for="hora_fin">Hora de Fin (7:00-22:00):</label>
            <input type="time" id="hora_fin" name="hora_fin" required
                   min="07:00" max="22:00">
        </div>

        <div>
            <label for="materia">Materia:</label>
            <select id="materia" name="materia" required>
                <option value="">Seleccione una materia</option>
                <option value="Matemáticas">Matemáticas</option>
                <option value="Física">Física</option>
                <option value="Química">Química</option>
            </select>
        </div>

        <button type="submit" id="submitBtn">Crear Reserva</button>
    </form>
</body>
</html>