-- Crear base de datos
CREATE DATABASE edulink;

-- Usar la base de datos creada
USE edulink;

-- Crear tabla de Usuarios
CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'administrativo', 'profesor', 'alumno', 'padre') NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla de Permisos
CREATE TABLE Permisos (
    id_permiso INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    permiso VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de Mensajes
CREATE TABLE Mensajes (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_remitente INT,
    id_destinatario INT,
    texto_mensaje TEXT,
    enviado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_remitente) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_destinatario) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de Lista de Procesos Administrativos
CREATE TABLE ListaProcesosAdministrativos (
    id_proceso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_proceso VARCHAR(50) NOT NULL,
    descripcion TEXT
);

-- Crear tabla de Procesos Administrativos
CREATE TABLE ProcesosAdministrativos (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_proceso INT,
    id_usuario INT,
    detalles TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_proceso) REFERENCES ListaProcesosAdministrativos(id_proceso),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de Horarios
CREATE TABLE Horarios (
    id_horario INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tipo_horario ENUM('alumno', 'profesor') NOT NULL,
    dia_semana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes') NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    asignatura VARCHAR(100),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de Cursos
CREATE TABLE Cursos (
    id_curso INT AUTO_INCREMENT PRIMARY KEY,
    nombre_curso VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Crear tabla de Resultados
CREATE TABLE Resultados (
    id_resultado INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT,
    asignatura VARCHAR(100),
    calificacion DECIMAL(4,2),
    calificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_alumno) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de Logs
CREATE TABLE Logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    accion VARCHAR(255),
    registrado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de asociación de alumnos y tutores
CREATE TABLE AlumnosTutores (
    id_alumno INT,
    id_tutor INT,
    PRIMARY KEY (id_alumno, id_tutor),
    FOREIGN KEY (id_alumno) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_tutor) REFERENCES Usuarios(id_usuario)
);

-- Crear tabla de asociación de alumnos y cursos
CREATE TABLE AlumnosCursos (
    id_alumno INT,
    id_curso INT,
    PRIMARY KEY (id_alumno, id_curso),
    FOREIGN KEY (id_alumno) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
);

-- Crear curso por defecto
INSERT INTO Cursos (nombre_curso, descripcion) VALUES 
('Curso de Ejemplo', 'Descripción del curso de ejemplo.');

-- Crear usuarios por defecto
INSERT INTO Usuarios (nombre_usuario, contrasena, rol) VALUES 
('admin', 'admin_password_hash', 'administrador'),
('administrativo_1', 'admin_password_hash_1', 'administrativo'),
('profesor_1', 'teacher_password_hash', 'profesor'),
('alumno_1', 'student_password_hash', 'alumno'),
('padre_1', 'parent_password_hash', 'padre');
-- Por ejemplo, se puede poner como contraseña "password", cuyo hash sería el siguiente
-- $2y$10$cYSK99em//EN8dEj.zeaMee3RbYGg6Qnje57tGeKpLhVLZWN5iYvW

-- Asignar curso al alumno
INSERT INTO AlumnosCursos (id_alumno, id_curso) VALUES 
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'alumno_1'), 
 (SELECT id_curso FROM Cursos WHERE nombre_curso = 'Curso de Ejemplo'));

-- Asignar tutor al alumno
INSERT INTO AlumnosTutores (id_alumno, id_tutor) VALUES 
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'alumno_1'), 
 (SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'profesor_1'));

-- Crear permisos por defecto
INSERT INTO Permisos (id_usuario, permiso) VALUES 
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'admin'), 'FULL_ACCESS'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'admin_1'), 'MANAGE_USERS'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'profesor_1'), 'VIEW_HORARIOS'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'alumno_1'), 'VIEW_CALIFICACIONES'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'padre_1'), 'COMMUNICATE_TEACHERS');

-- Crear horario para el alumno
INSERT INTO Horarios (id_usuario, tipo_horario, dia_semana, hora_inicio, hora_fin, asignatura) VALUES 
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'alumno_1'), 'alumno', 'Lunes', '08:00', '09:00', 'Matemáticas'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'alumno_1'), 'alumno', 'Martes', '10:00', '11:00', 'Ciencias');

-- Crear horario para el profesor
INSERT INTO Horarios (id_usuario, tipo_horario, dia_semana, hora_inicio, hora_fin, asignatura) VALUES 
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'profesor_1'), 'profesor', 'Lunes', '08:00', '09:00', 'Matemáticas'),
((SELECT id_usuario FROM Usuarios WHERE nombre_usuario = 'profesor_1'), 'profesor', 'Martes', '10:00', '11:00', 'Ciencias');