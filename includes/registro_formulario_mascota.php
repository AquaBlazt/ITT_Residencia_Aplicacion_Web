<?php if (! empty($ListaMascota->errors)): ?>
 
      <ul>
        <?php foreach ($ListaMascota->errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
 <?php endif; ?>
  </head>
  <body>
  <h2>Formulario de la Mascota</h2>
        <form method="post">   
          
<div>

          <label for="pic">Foto</label>
          <input class="field" type="file" name="pic" id="pic"/>
</div>

<div>
<label for="serial_number">Num. de serie</label>
          <input
            class="field"
            type="number"
            placeholder="Num. serie"
            name="serial_number"  
            id="serial_number" 
            value="<?= htmlspecialchars($ListaMascota->serial_number); ?>"
          />
</div>

<div>
<label for="mascot_name">Nombre</label>
          <input
            type="text"
            class="field"
            placeholder="Nombre"
            name="mascot_name"
            id="mascot_name"
            value="<?= htmlspecialchars($ListaMascota->mascot_name); ?>"
          />
</div>

<div>
<label for="age">Edad</label>
          <input
            type="number"
            class="field"
            placeholder="Edad"
            name="age"
            id="age"   
            value="<?= htmlspecialchars($ListaMascota->age); ?>"        
          />
</div>

<div>
<label for="gender">Genero</label>
          <select class="field" name="gender" id="gender" value="<?= htmlspecialchars($ListaMascota->gender); ?>">
            <option value="">--Elige una opcion--</option>
            <option value="1">Macho</option>
            <option value="2">Hembra</option>
          </select>
</div>

<div>
<label for="sickness">Enfermedad</label>
        <textarea name="sickness" id="sickness" cols="40" rows="12" placeholder="Describala"><?= htmlspecialchars($ListaMascota->sickness); ?></textarea>
</div>

<div>
<label for="sterilized">Su mascota se encuentra esterilizada?</label>
          <select class="field" name="sterilized" id="sterilized" value="<?= htmlspecialchars($ListaMascota->sterilized); ?>">>
          <option value="">--Elige una opcion--</option>
            <option value="1">Si</option>
            <option value="2">No</option>
          </select>
</div>
          
          <button type="submit" class="form-btn">Guardar</button>
          
        </form>