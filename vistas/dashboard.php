 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Panel de Administración</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Panel de Administración</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">

         <div class="container-fluid">

         </div>
</div>
<!-- /. Fin de Ventana Modal para ingreso de Expedientes de Pacientes -->




         <!-- row Tarjetas Informativas 
         <div class="row">

             <div class="col-lg-2">
                  small box 
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h4 id="totalProductos"></h4>

                         <p>Pacientes</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-clipboard"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
-->
             <!-- TARJETA TOTAL PAGOS 
             <div class="col-lg-2">
                  small box 
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h4 id="totalCompras">S./ 2,500.00</h4>

                         <p>Total Compras</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-cash"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div> -->

             <!-- TARJETA TOTAL VENTAS 
             <div class="col-lg-2">
                 small box 
                 <div class="small-box bg-warning">
                     <div class="inner">
                         <h4 id="totalVentas">S./ 1,200.00</h4>

                         <p>Total Ventas</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-ios-cart"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
-->
             <!-- TARJETA TOTAL GANANCIAS 
             <div class="col-lg-2">
                  small box 
                 <div class="small-box bg-danger">
                     <div class="inner">
                         <h4 id="totalGanancias">S./ 470.00</h4>

                         <p>Total Ganancias</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-ios-pie"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
-->
             <!-- TARJETA PRODUCTOS POCO STOCK 
             <div class="col-lg-2">
                 small box 
                 <div class="small-box bg-primary">
                     <div class="inner">
                         <h4 id="totalProductosMinStock">15</h4>

                         <p>Productos poco stock</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-android-remove-circle"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>

              TARJETA TOTAL VENTAS DIA ACTUAL
             <div class="col-lg-2">
                  small box 
                 <div class="small-box bg-secondary">
                     <div class="inner">
                         <h4 id="totalVentasHoy">S./ 250.00</h4>

                         <p>Ventas del día</p>
                     </div>
                     <div class="icon">
                         <i class="ion ion-android-calendar"></i>
                     </div>
                     <a style="cursor:pointer;" class="small-box-footer">Mas Info <i
                             class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             -->

         <!-- </div> ./row Tarjetas Informativas -->

         <!-- row Grafico de barras 
         <div class="row">

             <div class="col-12">

                 <div class="card card-info">

                     <div class="card-header">

                         <h3 class="card-title" id="title-header"></h3>

                         <div class="card-tools">

                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
                             </button>

                         </div> 

                     </div> 
                     

                     <div class="card-body">

                         <div class="chart">

                             <canvas id="barChart"
                                 style="min-height: 250px; height: 300px; max-height: 350px; width: 100%;">

                             </canvas>

                         </div>

                     </div> 

                 </div>

             </div>

         </div> -->
<!--
         <div class="row">
             <div class="col-lg-6">
                 <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Los 10 productos mas vendidos</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div> 
                     <div class="card-body">
                         <div class="table-responsive">
                             <table class="table" id="tbl_productos_mas_vendidos">
                                 <thead>
                                     <tr class="text-danger">
                                         <th>Cod. producto</th>
                                         <th>Producto</th>
                                         <th>Cantidad</th>
                                         <th>Ventas</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                 </tbody>
                             </table>
                         </div>
                     </div> 
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Listado de productos con poco stock</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                             <button type="button" class="btn btn-tool" data-card-widget="remove">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div> 
                     </div> 
                     <div class="card-body">
                     <div class="table-responsive">
                             <table class="table" id="tbl_productos_poco_stock">
                                 <thead>
                                     <tr class="text-danger">
                                         <th>Cod. producto</th>
                                         <th>Producto</th>
                                         <th>Stock Actual</th>
                                         <th>Mín. Stock</th>
                                     </tr>
                                 </thead>
                                 <tbody></tbody>
                             </table>
                         </div>
                     </div> 
                 </div>
             </div>
         </div>

     </div>



 </div>
-->


 <script>


                     
 </script>
 