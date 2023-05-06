<form method="post">
          <h1>Inicio de Sesion</h1>
          <?php if ($invalido): ?>
            <em>Inicio de sesion invalido</em>
            <?php endif; ?>
          <input
            type="text"
            placeholder="E-mail"
            class="field"
            name="email"
            id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
          />

          <input
            type="password"
            placeholder="Contraseña"
            class="field"
            name="password"
          />

          <button type="submit" class="form-btn" name="log-in">
            Iniciar sesion
          </button>
          
        </form>