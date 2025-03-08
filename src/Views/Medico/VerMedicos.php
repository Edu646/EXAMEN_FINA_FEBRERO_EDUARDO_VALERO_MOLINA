<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Médicos</title>
    <style>
      /* Variables globales */
:root {
  --primary-color: #0077cc;
  --secondary-color: #005fa3;
  --accent-color: #4CAF50;
  --text-color: #333333;
  --light-text: #666666;
  --background: #f9f9f9;
  --card-bg: #ffffff;
  --border-radius: 8px;
  --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  --transition: all 0.3s ease;
}

/* Estilos generales */
body {
  font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
  background-color: var(--background);
  margin: 0;
  padding: 0;
  color: var(--text-color);
  line-height: 1.6;
}

/* Encabezado principal */
#P {
  text-align: center;
  color: var(--primary-color);
  margin: 0;
  padding: 30px 0;
  font-size: 2.5rem;
  font-weight: 700;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  background-color: var(--card-bg);
  box-shadow: var(--shadow);
  position: relative;
}

#P::after {
  content: "";
  display: block;
  width: 80px;
  height: 4px;
  background-color: var(--accent-color);
  margin: 10px auto 0;
  border-radius: 2px;
}

/* Contenedor principal */
.container {
  width: 85%;
  max-width: 1200px;
  margin: 30px auto;
  background-color: transparent;
  padding: 0;
}

/* Tarjetas de médicos */
.product {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 25px;
  border: none;
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  padding: 20px;
  transition: var(--transition);
  overflow: hidden;
  position: relative;
}

.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
}

.product::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 6px;
  background-color: var(--accent-color);
}

/* Detalles del médico */
.product-details {
  flex: 1;
  padding: 10px 15px;
}

.product-details h2 {
  margin-top: 0;
  margin-bottom: 15px;
  color: var(--primary-color);
  font-size: 1.5rem;
  font-weight: 600;
}

.product-details p {
  margin: 12px 0;
  font-size: 1rem;
  color: var(--light-text);
}

.product-details p strong {
  color: var(--text-color);
  margin-right: 8px;
  font-weight: 600;
}

/* Mensaje cuando no hay médicos */
.container > p {
  text-align: center;
  padding: 30px;
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  color: var(--light-text);
  font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
  .container {
    width: 92%;
  }
  
  #P {
    font-size: 2rem;
    padding: 20px 0;
  }
  
  .product-details h2 {
    font-size: 1.3rem;
  }
}

@media (max-width: 480px) {
  .container {
    width: 95%;
  }
  
  #P {
    font-size: 1.8rem;
  }
  
  .product {
    padding: 15px;
  }
  
  .product-details h2 {
    font-size: 1.2rem;
  }
  
  .product-details p {
    font-size: 0.95rem;
  }
}
    </style>
</head>
<body>
    <h1 id="P">Lista de Médicos</h1>
    <div class="container">
        <?php if (!empty($medicos)): ?>
            <?php foreach ($medicos as $medico): ?>
                <div class="product">
                    <div class="product-details">
                        <h2><?= htmlspecialchars($medico->getNombre()) ?></h2>
                        <p><strong>Nombre:</strong> <?= htmlspecialchars($medico->getNombre()) ?></p>
                        <p><strong>Apellidos:</strong> <?= htmlspecialchars($medico->getApellidos()) ?></p> <!-- Corregido -->
                        <p><strong>Especialidad:</strong> <?= htmlspecialchars($medico->getEspecialidadNombre()) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay médicos registrados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
