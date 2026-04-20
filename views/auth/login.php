<section class="auth-wrapper">
    <div class="auth-card">
        <div class="panel-heading">
            <p class="eyebrow">Acceso seguro</p>
            <h1>Iniciar sesión</h1>
            <p class="muted">Accede al panel administrativo para gestionar productos empresariales.</p>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/?route=login" class="form-grid">
            <input type="hidden" name="_token" value="<?= e($csrf); ?>">

            <div class="form-group">
                <label for="email">Correo corporativo</label>
                <input id="email" name="email" type="email" placeholder="admin@empresa.com" value="<?= $this->old('email'); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" placeholder="••••••••" required>
            </div>

            <button class="btn btn-primary" type="submit">Entrar al sistema</button>
        </form>

        <div class="demo-box">
            <strong>Demo portfolio</strong>
            <span>Email: admin@empresa.com</span>
            <span>Clave: Admin123*</span>
        </div>
    </div>
</section>
