<!-- Main Footer -->
<footer class="main-footer">
    <!-- Elemento más a la derecha: "Hecho en México" -->
    <div class="float-right d-none d-sm-inline">
        Hecho en México
    </div>

    <!-- Elemento de la derecha (a la izquierda de "Hecho en México"): Derechos Reservados -->
    <div class="float-right" style="margin-right: 1rem;"> <!-- 1rem de margen para separarlo -->
        <strong>Derechos Reservados &copy; 2025 <a href="">CUASystem</a>.</strong> Todos los derechos Reservados.
    </div>

    <!-- Elemento de la izquierda: Nombre del Usuario -->
    <strong>Usuario: <?php echo isset($_SESSION['S_NOMBRE']) ? htmlspecialchars($_SESSION['S_NOMBRE']) : 'Usuario'; ?></strong>

</footer>