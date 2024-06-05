<div id="sidebar-wrapper">
  <div class="sidebar-heading text-center py-4"><i class="fas fa-user-circle fa-2x"></i></div>
  <div class="list-group list-group-flush">
    <a href="index.php?action=dashboard" class="list-group-item list-group-item-action"><i class="fas fa-th-large me-2"></i> Inicio</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-user me-2"></i> Cuenta</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-history me-2"></i> Historial Pedido</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-map-marker-alt me-2"></i> Donde Encontrarnos</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart me-2"></i> Carrito</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-heart me-2"></i> Lista Deseados</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list me-2"></i> Datos para pedido</a>
    <a href="index.php?action=logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</a>
    <!-- Nuevos CRUDs -->
    <a href="User_Controller.php?action=listUsers" class="list-group-item list-group-item-action"><i class="fas fa-users me-2"></i> Usuarios</a>
    <a href="index.php?action=listProducts" class="list-group-item list-group-item-action"><i class="fas fa-boxes me-2"></i> Productos</a>
    <?php if ($role == 'admin') { ?>
      <a href="index.php?action=listPaymentMethods" class="list-group-item list-group-item-action"><i class="fas fa-credit-card me-2"></i> Formas de Pago</a>
      <a href="index.php?action=listCategories" class="list-group-item list-group-item-action"><i class="fas fa-tags me-2"></i> Categorías</a>
    <?php } ?>
    <a href="index.php?action=listClients" class="list-group-item list-group-item-action"><i class="fas fa-user-friends me-2"></i> Clientes</a>
    <a href="index.php?action=listSuppliers" class="list-group-item list-group-item-action"><i class="fas fa-truck me-2"></i> Proveedores</a>
    <a href="index.php?action=listOrders" class="list-group-item list-group-item-action"><i class="fas fa-receipt me-2"></i> Pedidos</a>
  </div>
</div>
