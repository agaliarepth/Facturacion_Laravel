<!DOCTYPE html>
<html lang="es">
@include('includes.header')

<body class="sticky-header">

<section>
    @include('includes.sidebar')
    
    <!-- main content start-->
    <div class="main-content" >
        @include('includes.notification')
       
 <!-- header section end-->

        <!-- page heading start-->
        <!--<div class="page-heading">
            <h3>
                Dashboard
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li class="active"> My Dashboard </li>
            </ul>
            <div class="state-info">
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>yearly expense</span>
                            <h3 class="red-txt">$ 45,600</h3>
                        </div>
                        <div id="income" class="chart-bar"></div>
                    </div>
                </section>
                <section class="panel">
                    <div class="panel-body">
                        <div class="summary">
                            <span>yearly  income</span>
                            <h3 class="green-txt">$ 45,600</h3>
                        </div>
                        <div id="expense" class="chart-bar"></div>
                    </div>
                </section>
            </div>
        </div>
        -->
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
           
                     @yield('content')
                
           
        </div>
        <!--body wrapper end-->


       @include('includes.footer')


    </div>
    <!-- main content end-->
</section>

 @include('partials.scripts')


</body>
</html>
