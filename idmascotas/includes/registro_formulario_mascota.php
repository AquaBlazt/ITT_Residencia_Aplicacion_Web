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
   <label for="usuario_id">ID del Usuario</label>
   <input
       class="field"
       type="number"
       placeholder="ID"
       name="usuario_id"  
       id="usuario_id" 
       value="<?= htmlspecialchars($ListaMascota->usuario_id); ?>"
     />
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
<label for="age">Edad(En años)</label>
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
<label for="gender">Género</label>
<select class="field" name="gender" id="gender">
<option value="">--Elige una opción--</option>
<option value="1" <?= ($ListaMascota->gender == "1") ? "selected" : ""; ?>>Macho</option>
<option value="2" <?= ($ListaMascota->gender == "2") ? "selected" : ""; ?>>Hembra</option>
</select>
</div>

<div>
<label for="sickness">Enfermedad</label>
   <textarea name="sickness" id="sickness" cols="40" rows="12" placeholder="Describala"><?= htmlspecialchars($ListaMascota->sickness); ?></textarea>
</div>

<div>
<label for="sterilized">¿Su mascota se encuentra esterilizada?</label>
<select class="field" name="sterilized" id="sterilized">
<option value="">--Elige una opción--</option>
<option value="1" <?= ($ListaMascota->sterilized == "1") ? "selected" : ""; ?>>Si</option>
<option value="2" <?= ($ListaMascota->sterilized == "2") ? "selected" : ""; ?>>No</option>
</select>
</div>


<div>
<label for="phone_number">Num. Telefonico(Se usara en casos de extravio)</label>
     <input
       type="number"
       class="field"
       placeholder="Num. Telefonico"
       name="phone_number"
       id="phone_number"   
       value="<?= htmlspecialchars($ListaMascota->phone_number); ?>"        
     />
</div>
     
     <button type="submit" class="form-btn">Guardar</button>
     
   </form>