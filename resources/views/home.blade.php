@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-center">
                    {{-- Título + Logo --}}
                    <img src="{{ asset('dist/img/LOGOGRANDE.png') }}" 
                         alt="Logo de Plugin" 
                         style="height:50px; width:auto;">
                </div>
                <div class="card-body p-4">
                    <p class="lead">
                        <strong>Plugin</strong> es una contratista dedicada a ofrecer servicio de internet por cable a
                        clientes residenciales y comerciales. Hasta el momento, toda su operación interna se gestiona
                        en papel: desde la recepción de pedidos, la planificación de trabajos, el control de stock y el
                        seguimiento de vehículos, hasta la administración de licencias y vacaciones.
                    </p>
                    <p>
                        Este método provoca retrasos, pérdida de información, errores en la asignación de tareas y una
                        ausencia de trazabilidad en las operaciones. Con el objetivo de modernizarse, la empresa ha
                        decidido implementar un sistema integral que unifique la información, optimice procesos y facilite
                        la toma de decisiones.
                    </p>

                    <h5 class="mt-4">📋 Proceso del Nuevo Sistema</h5>
                    <p>
                        El proceso comenzará cuando un cliente envíe una solicitud a través de un portal web. El pedido
                        será recibido por el jefe o gerente, quien decidirá a qué móvil asignarlo. Un móvil está compuesto
                        por dos o tres empleados y un vehículo, y puede realizar varias tareas en un mismo domicilio.
                        Estos grupos pueden rotar integrantes según la disponibilidad del personal.
                    </p>

                    <h5 class="mt-4">👥 Asignación y Seguimiento de Tareas</h5>
                    <p>
                        Cada orden de trabajo contará con un número único, fecha, grupo de trabajo asignado y el detalle
                        de todas las tareas realizadas. El workflow de las órdenes permitirá seguir el ciclo completo:
                        <em>nueva → vista → en proceso → terminada o no terminada</em>, registrando siempre el motivo en
                        este último caso (por ejemplo, fallas técnicas, mal clima o rechazo del cliente).
                    </p>
                    <p>
                        La asignación de tareas a los empleados estará basada en sus skills. El sistema permitirá asignarles
                        un pool de tareas para un período determinado, medir rendimiento y establecer un ranking semanal,
                        clave para la asignación de trabajos a clientes premium.
                    </p>

                    <h5 class="mt-4">📦 Gestión de Stock y Materiales</h5>
                    <p>
                        Cada tarea requerirá materiales específicos. El sistema gestionará el stock, descontando
                        automáticamente los insumos entregados y generando alertas cuando un material esté próximo a
                        agotarse. Además, se registrarán las compras a proveedores y se actualizará el inventario al recibir
                        la mercadería.
                    </p>

                    <h5 class="mt-4">🏖️ Gestión de Personal</h5>
                    <p>
                        Los empleados podrán solicitar vacaciones a través del sistema. El jefe podrá aprobarlas o
                        rechazarlas aplicando criterios de equidad. También se administrarán licencias y ausencias,
                        con causas parametrizables como enfermedad, accidente laboral o motivos personales.
                    </p>

                    <h5 class="mt-4">🚗 Control de Vehículos</h5>
                    <p>
                        Cada rodado estará registrado con su información clave: patente, modelo, vencimiento de la
                        verificación técnica, estado y mantenimiento pendiente. El sistema permitirá visualizar un estado
                        general de todos los rodados y anticipar necesidades de mantenimiento.
                    </p>

                    <h5 class="mt-4">📊 Dashboard y Reportes</h5>
                    <p>
                        Al iniciar sesión, el jefe verá gráficos y estadísticas con la información más relevante: número de
                        órdenes programadas para el día, empleados asignados, estado del stock, vehículos que requieren
                        mantenimiento y alertas críticas sobre clientes premium. Desde este panel se podrán solicitar
                        reportes PDF con información detallada y comparativas de rendimiento.
                    </p>

                    <h5 class="mt-4">💬 Comunicación Interna</h5>
                    <p>
                        El sistema incluirá un módulo de mensajería interna para facilitar la comunicación entre jefe,
                        empleados y móviles, enviando notificaciones en tiempo real sobre asignaciones, cambios de
                        estado, alertas de stock o decisiones sobre vacaciones y licencias. 
                    </p>

                    <h5 class="mt-4">🔒 Perfiles y Seguridad</h5>
                    <p>
                        Habrá diferentes perfiles de usuario con permisos específicos: jefe o administrativo, empleado y
                        cliente, permitiendo un acceso seguro y controlado a la información.
                    </p>

                    <div class="alert alert-info mt-4 mb-0">
                        <strong>Con Plugin, tu empresa dejará atrás el caos del papel y ganará en eficiencia, control y capacidad de respuesta.</strong>
                    </div>

                    <p class="text-end text-muted mt-3 mb-0">
                        Fecha de actualización: 13/08/2025
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
