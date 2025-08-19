<?php
// Conexión a la base de datos SQLite
$db = new PDO('sqlite:LA_BIBLIOTECA.db');

// Crear tabla si no existe
$db->exec("CREATE TABLE IF NOT EXISTS ubicacion (
    id_ubic INTEGER PRIMARY KEY AUTOINCREMENT,
    area TEXT NOT NULL,
    abreviatura TEXT NOT NULL,
    pasillo TEXT NOT NULL,
    estante INTEGER NOT NULL,
    nivel INTEGER NOT NULL,
    codigo TEXT UNIQUE NOT NULL
);");

// Insertar registros
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Literatura Infantil / Juvenil', 'LITINF', 'A', 1, 1, 'LITINF-A-1-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Matemática', 'MAT', 'B', 2, 2, 'MAT-B-2-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Ciencias Naturales / Tecnología / Medioambiente', 'CIENAT', 'C', 3, 3, 'CIENAT-C-3-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Lengua Extranjera / Enseñanza del Inglés', 'LENEXT', 'D', 4, 4, 'LENEXT-D-4-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Artística / Convivencia Escolar', 'EDUART', 'E', 1, 5, 'EDUART-E-5-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Didáctico / Formación Docente', 'DIDAC', 'F', 2, 6, 'DIDAC-F-6-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Lengua y Literatura / Prácticas del Lenguaje', 'LENG', 'G', 3, 7, 'LENG-G-7-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Ciencias Sociales / Historia / Geografía', 'CISO', 'H', 4, 8, 'CISO-H-8-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Sexual Integral (ESI)', 'ESI', 'I', 1, 9, 'ESI-I-9-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Inicial / Nivel Primario', 'EDINIP', 'J', 2, 10, 'EDINIP-J-10-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Física / Juego y Movimiento', 'EDUFIS', 'A', 3, 11, 'EDUFIS-A-11-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Filosofía / Formación Ética y Ciudadana', 'FILOS', 'B', 4, 12, 'FILOS-B-12-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Psicología / Neurociencias / Educación Emocional', 'PSICO', 'C', 1, 13, 'PSICO-C-13-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Pedagogía Crítica / Gestión Escolar / Evaluación', 'PEDA', 'D', 2, 14, 'PEDA-D-14-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Proyectos Institucionales / Currículo / Planificación', 'PROY', 'E', 3, 15, 'PROY-E-15-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Inclusión / Diversidad / Interculturalidad', 'INCLU', 'F', 4, 16, 'INCLU-F-16-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Arte y Literatura Argentina', 'ARTELIT', 'G', 1, 17, 'ARTELIT-G-17-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('TIC / Informática Educativa / Recursos Digitales', 'TIC', 'H', 2, 18, 'TIC-H-18-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Investigación Educativa / Tesis / Ensayos', 'INVEST', 'I', 3, 19, 'INVEST-I-19-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Ambiental / Sostenibilidad', 'AMBIENT', 'J', 4, 20, 'AMBIENT-J-20-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación en Pandemia / Nuevos Escenarios', 'PANDEM', 'A', 1, 21, 'PANDEM-A-21-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Teoría Educativa / Sociología / Política de la Educación', 'TEO', 'B', 2, 22, 'TEO-B-22-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Antologías / Compilaciones Literarias', 'ANTO', 'C', 3, 23, 'ANTO-C-23-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Teatro / Expresión Corporal / Narración Oral', 'TEATRO', 'D', 4, 24, 'TEATRO-D-24-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Lectura y Escritura / Talleres / Producción Textual', 'LECTESCR', 'E', 1, 25, 'LECTESCR-E-25-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Revistas Educativas / Publicaciones Especiales', 'REVIST', 'F', 2, 26, 'REVIST-F-26-2');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Manual Escolar / Recursos Didácticos Generales', 'MANUAL', 'G', 3, 27, 'MANUAL-G-27-3');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Mapas / Atlas / Cartografía Escolar', 'MAPA', 'H', 4, 28, 'MAPA-H-28-4');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Educación Rural / Contextos Desfavorecidos', 'RURAL', 'I', 1, 29, 'RURAL-I-29-1');");
$db->exec("INSERT INTO ubicacion (area, abreviatura, pasillo, nivel, estante, codigo) VALUES ('Historia Argentina / Historia Universal / Procesos Políticos', 'HIST', 'J', 2, 30, 'HIST-J-30-2');");
echo 'Datos insertados correctamente.';
?>