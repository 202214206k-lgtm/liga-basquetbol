# Documentación técnica: Gestión de Liga de Básquetbol

## 1. Descripción del proyecto

El proyecto consiste en desarrollar una aplicación web para administrar una liga de básquetbol. Permite gestionar equipos, jugadores y partidos, además de consultar los resultados registrados. La aplicación utiliza PHP con Laravel, una base de datos MySQL y Git/GitHub para el control de versiones.

## 2. Arquitectura de la aplicación

La aplicación utiliza la arquitectura Modelo-Vista-Controlador (MVC) de Laravel.

- **Modelos:** representan los datos y las relaciones con la base de datos.
- **Vistas:** utilizan Blade para presentar formularios, tablas y páginas.
- **Controladores:** procesan las solicitudes y coordinan las operaciones de la aplicación.
- **Rutas:** se encuentran en `routes/web.php` y conectan las solicitudes con las acciones correspondientes.

Esta separación organiza el código y facilita el mantenimiento del sistema.

## 3. Modelos y relaciones

Los principales modelos son `Equipo`, `Jugador` y `Partido`.

El modelo `Equipo` contiene los campos `nombre`, `ciudad`, `entrenador` y `activo`. Define relaciones de uno a muchos con los jugadores, los partidos como equipo local y los partidos como equipo visitante.

El modelo `Jugador` utiliza la tabla `jugadores` y contiene `nombres`, `apellidos`, `dorsal`, `posicion` y `equipo_id`. Cada jugador pertenece a un equipo mediante la relación `equipo()`. La base de datos impide repetir un dorsal dentro del mismo equipo y elimina sus jugadores asociados cuando se elimina el equipo.

El modelo `Partido` contiene `equipo_local_id`, `equipo_visitante_id`, `fecha`, `lugar`, `puntos_local`, `puntos_visitante` y `estado`. Se relaciona con los equipos mediante `equipoLocal()` y `equipoVisitante()`. Los estados permitidos son `programado`, `en_juego`, `finalizado` y `suspendido`.

## 4. Controladores y funcionalidades

- `EquipoController`: administra las operaciones de creación, consulta, edición y eliminación de equipos.
- `JugadorController`: gestiona los registros de jugadores y su información.
- `PartidoController`: administra los partidos y sus resultados registrados.
- `DashboardController`: presenta contadores de equipos, jugadores y partidos.

La aplicación incluye registro e inicio de sesión, cierre de sesión, formularios con validación y pantallas para consultar y modificar la información. Las vistas se encuentran en `resources/views` y los estilos compartidos en `public/css/estilos.css`.

## 5. Fragmento de código

El siguiente fragmento representa la relación entre un equipo y sus jugadores:

```php
public function jugadores(): HasMany
{
    return $this->hasMany(Jugador::class);
}
```

Esta relación permite obtener los jugadores asociados a un equipo utilizando las herramientas de Eloquent, el ORM de Laravel.

## 6. Base de datos y pruebas

Las migraciones crean las tablas `equipos`, `jugadores` y `partidos`, además de las tablas predeterminadas de Laravel para usuarios, caché y tareas en cola.

En la tabla `partidos`, las claves foráneas impiden eliminar equipos que todavía estén relacionados con encuentros. Las puntuaciones comienzan en cero y el estado inicial es `programado`.

Durante el desarrollo se resolvieron problemas con las rutas de autenticación, la redirección al panel principal y la inclusión del menú. También se corrigió una prueba automatizada para comprobar que los usuarios no autenticados sean redirigidos al inicio de sesión. En una ejecución de `php artisan test` se obtuvieron 27 pruebas aprobadas y 62 aserciones.

## 7. Control de versiones y mejoras futuras

El proyecto utiliza ramas de Git para trabajar en funcionalidades específicas, commits descriptivos y Pull Requests en GitHub para integrar los cambios en `main`. Este procedimiento conserva el historial de desarrollo y permite revisar las modificaciones.

Como mejora futura, se podrían implementar estadísticas calculadas, como victorias, derrotas y clasificaciones, además de estadísticas individuales de jugadores. Estas funciones deberán considerarse pendientes hasta comprobar que estén implementadas.