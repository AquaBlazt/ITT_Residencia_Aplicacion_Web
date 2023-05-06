<?php if (! empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
 <?php endif; ?>
 
  </head>
  <body>
    <h2>Formulario del Usuario</h2>
    <form method="post" novalidate>
      <div>
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" placeholder="Nombre" value="<?= htmlspecialchars($name); ?>"  />
      </div>

      <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($email); ?>"    />
      </div>
      <div>
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Contraseña" name="password" value="<?= htmlspecialchars($password); ?>"/>
      </div>
      <div>
        <label for="password_confirmation">Confirme la Contraseña</label>
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Confirmar contraseña"
          value="<?= htmlspecialchars($password_confirmation); ?>"
        />
      </div>


      <div>
<label for="address">Direccion</label>
          <input
            type="text"
            placeholder="Direccion"
            name="address"
            id="address"
            class="field"
            value="<?= htmlspecialchars($address); ?>"
          />
</div>


      <div>
<label for="phone_number">Num. Telefonico</label>
          <input
            type="number"
            placeholder="Num. Telefonico"
            name="phone_number"
            id="phone_number"
            class="field"
            value="<?= htmlspecialchars($phone_number); ?>"
          />
</div>

<div>
<label for="phone_number_extra">2do. Num. Telefonico</label>
          <input
            type="number"
            placeholder="Num. Telefonico"
            name="phone_number_extra"
            id="phone_number_extra"
            class="field"
            value="<?= htmlspecialchars($phone_number_extra); ?>"
          />
</div>

      <button>Guardar</button>
    </form>