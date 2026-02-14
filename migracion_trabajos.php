<?php
require_once 'conexion.php';

echo "<h2>Migración de Tabla de Trabajos</h2>";

// 1. Crear tabla de trabajos
$sql = "CREATE TABLE IF NOT EXISTS trabajos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    archivo VARCHAR(255) NOT NULL,
    estudiante_id INT NOT NULL,
    materia_id INT NOT NULL,
    periodo_id INT NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (estudiante_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (materia_id) REFERENCES materias(id) ON DELETE CASCADE,
    FOREIGN KEY (periodo_id) REFERENCES periodos(id) ON DELETE CASCADE
)";

if ($conn->query($sql)) {
    echo "<p style='color:green;'>✅ Tabla 'trabajos' creada correctamente.</p>";
} else {
    echo "<p style='color:red;'>❌ Error al crear tabla: " . $conn->error . "</p>";
}

// 2. Crear directorio de subida
$upload_dir = 'uploads/trabajos';
if (!is_dir($upload_dir)) {
    if (mkdir($upload_dir, 0777, true)) {
        echo "<p style='color:green;'>✅ Directorio 'uploads/trabajos' creado.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error al crear directorio 'uploads/trabajos'.</p>";
    }
} else {
    echo "<p style='color:blue;'>ℹ️ Directorio 'uploads/trabajos' ya existe.</p>";
}

echo "<p><a href='dashboard_admin.php'>Volver al inicio</a></p>";
