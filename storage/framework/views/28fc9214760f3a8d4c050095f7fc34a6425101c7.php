<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Relatório Gerencial</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Diploma Digital" />
    <meta name="keywords" content="adm,dashboard" />
    <meta name="author" content="Steelcoders" />

     <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="<?php echo e(asset('plugin/plugins/pace-master/themes/blue/pace-theme-flash.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('plugin/plugins/uniform/css/uniform.default.min.css')); ?>" rel="stylesheet"/>
        <link href="<?php echo e(asset('plugin/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/fontawesome/css/font-awesome.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/line-icons/simple-line-icons.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/offcanvasmenueffects/css/menu_cornerbox.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/waves/waves.min.css" rel="stylesheet')); ?>" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/switchery/switchery.min.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/3d-bold-navigation/css/style.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/slidepushmenus/css/component.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/plugins/morris/morris.css')); ?>" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="<?php echo e(asset('plugin/css/modern.min.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/css/themes/green.css')); ?>" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('plugin/css/custom.css')); ?>" rel="stylesheet" type="text/css"/>

        <script src="<?php echo e(asset('plugin/plugins/3d-bold-navigation/js/modernizr.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/offcanvasmenueffects/js/snap.svg-min.js')); ?>"></script>
          <!-- Logo pequeno  -->
    <link rel="shortcut icon" href="<?php echo e(asset('imagens/grau_certo_logo.jpg')); ?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body>
	<div class="page-inner">
		<div id="main-wrapper">
			<div class="page-title">
                <h3 align="center"><img src="<?php echo e(asset('imagens/grau_certo_logo.jpg')); ?>" alt="Logo" width="60" height="40"class="brand-image -circle elevation-3"> System Grau Certo</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                    	<!--
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Charts</a></li>
                        <li class="active">Morris Charts</li>
                    -->
                    </ol>
                </div>
            </div>
	        <div class="container-fluid">
	            <?php if(Session::has('error2')): ?>
	            <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <strong>OPS!</strong> Você não pode acessa a pagina solicitada.
	                <?php if(count($errors) > 0): ?>
	                <ul>
	                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <li><?php echo e($error); ?></li>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                </ul>
	                <?php endif; ?>
	            </div>
	            <?php endif; ?>

	            <?php echo csrf_field(); ?>
	        </div>
			<h1 align="center">Relatório Gerencial do Setor <?php echo e($setor); ?></h1>

			<h3 class=" mx-md-4">
				<?php if($abertosDpto > 0): ?>
						Chamados temos <?php echo e($abertosDpto); ?>, sendo que:<br>
						Sem atendimento: <?php echo e($qtdAbertos); ?> ;<br>
						Em atendimento: <?php echo e($atendimento); ?> ;<br>
						Encerrados: <?php echo e($qtdFechados); ?> .
				<?php else: ?> Não temos chamados!
				<?php endif; ?>
				<!-- <button id="btn" type="button" class="btn btn-primary"><i class="nav-icon far fa-copy"></i> imprimir</button> -->
			</h3>
			<br>
			<table id="chamados" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nº O.S</th>
						<th>TITULO</th>
						<th>Abertura</th>
						<th>Usuario</th>
						<th>STATUS</th>
						<th>Visualizou</th>
						<th>Atendente</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $chamados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chamado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<input hidden="" type="text"
						value=" <?php echo e($diferenca = strtotime(date('Y-m-d H:i:s')) - strtotime($chamado->DATA_ABERTURA)); ?>">
					<input hidden="" type="text"
						value=" <?php echo e($dias = floor($diferenca / (60 * 60 * 24))); ?>"> <?php if($dias
					> 7 && $chamado->STATUS != 'F'): ?>
					<tr style="color: red;"><?php elseif($dias <= 7 && $dias > 4 &&
						$chamado->STATUS != 'F'): ?>
					<tr style="color: orange;"><?php elseif($dias <= 4 && $chamado->STATUS !=
						'F'): ?>
					<tr style="color: green;"><?php else: ?>
					<tr>
						<?php endif; ?>
						<th><?php echo e($chamado->NM_CHAMADO); ?></th>
						<th><?php echo e($chamado->d_descricao); ?></th>
						<th><?php echo e(date('d/m/Y', strtotime($chamado->DATA_ABERTURA))); ?></th>
						<td><?php echo e($chamado->USU_LOGIN); ?></td>
						<td><?php if($chamado->STATUS == 'A'): ?> Aberto <?php elseif($chamado->STATUS ==
							'E'): ?> Em Atendimento <?php else: ?> Fechado <?php endif; ?></td>
						<?php if($chamado->VIEW == 'S'): ?>
	                       <td style="color: green;"><?php if($chamado->VIEW == 'S'): ?> SIM <?php endif; ?></td>
	                    <?php else: ?>
	                    <td style="color: red;"><?php if($chamado->VIEW == 'N'): ?> Não <?php endif; ?></td>
	                      <?php endif; ?>
						<td><?php echo e($chamado->ATENDENTE); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
	<br>
	<div class="page-inner">
        <div id="main-wrapper">
        	<div class="row">
        		<div class="col-lg-3 col-md-6">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo e($abertosDpto); ?></p>
                                <span class="info-box-title">Total O.S Abertas</span>
                            </div>
                            <div class="info-box-icon">
                                <i class="icon-check"></i>
                            </div>
                            <div class="info-box-progress">
                                <div class="progress progress-xs progress-squared bs-n">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo e($qtdEncerrados); ?></p>
                                <span class="info-box-title">Total O.S Encerradas</span>
                            </div>
                            <div class="info-box-icon">
                                <i class="icon-like"></i>
                            </div>
                            <div class="info-box-progress">
                                <div class="progress progress-xs progress-squared bs-n">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo e($percente); ?><sup style="font-size: 20px">%</sup></p>
                                <span class="info-box-title">Solucionados</span>
                            </div>
                            <div class="info-box-icon">
                                <i class="icon-graph"></i>
                            </div>
                            <div class="info-box-progress">
                                <div class="progress progress-xs progress-squared bs-n">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo e($qtdSemAtendimmento); ?></p>
                                <span class="info-box-title">O.S não atendidas</span>
                            </div>
                            <div class="info-box-icon">
                                <i class="icon-dislike"></i>
                            </div>
                            <div class="info-box-progress">
                                <div class="progress progress-xs progress-squared bs-n">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo e($qtdEmAtendimento); ?></p>
                                <span class="info-box-title">O.S Em Atendimento</span>
                            </div>
                            <div class="info-box-icon">
                                <i class=" icon-wrench"></i>
                            </div>
                            <div class="info-box-progress">
                                <div class="progress progress-xs progress-squared bs-n">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group col-4"></div>
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-body">
                            <p class="no-s">Graficos demostrativos</p>
                        </div>
                    </div>
                </div>
			</div>
			<br>
            <section>

                <div class="row">
                    <div class=" col-sm-4">
                        <div class="panel info-box panel-white">
                            <div class="panel-heading">
                                <h3 class="panel-title">O.S Por Mês</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris2"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-4">
                        <div class="panel info-box panel-white">
                            <div class="panel-heading">
                                <h3 class="panel-title">Quantidade de O.S</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris4"></div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
            </section>
            </div><!-- Row -->
        </div><!-- Main Wrapper -->
    </div><!-- Page Inner -->
		<!-- Javascripts -->
        <script src="<?php echo e(asset('plugin/plugins/jquery/jquery-2.1.4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/pace-master/pace.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/pugins/jquery-blockui/jquery.blockui.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/switchery/switchery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/uniform/jquery.uniform.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/offcanvasmenueffects/js/classie.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/offcanvasmenueffects/js/main.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/waves/waves.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/3d-bold-navigation/js/main.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/chartsjs/Chart.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/js/modern.min.js')); ?>"></script>
        <!--<script src="<?php echo e(asset('plugin/js/pages/charts-chartjs.js')); ?>"></script>-->
        <!--<script src="<?php echo e(asset('plugin/js/pages/charts-morris.js')); ?>"></script>-->
        <script src="<?php echo e(asset('plugin/plugins/morris/raphael.min.js')); ?>"></script>
        <script src="<?php echo e(asset('plugin/plugins/morris/morris.min.js')); ?>"></script>



        <!-- Novo
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
		<script>
	      document.getElementById('btn').onclick = function() {
	          window.print();
	        };
     	</script>
<script>




/************** Cria graficos JS ***********************/
$( document ).ready(function() {
    var dados      = <?php echo $chamados ?>;
	     var abertos    = <?php echo json_encode($abertos)?>;
	     var fechado    = <?php echo json_encode($fechados )?>;
	     var atendendo  = <?php echo json_encode($emAtendimento )?>;

	     var qdtAbertos    = <?php echo ($qtdSemAtendimmento )?>;
	     var qtdFechado    = <?php echo ($qtdEncerrados )?>;
	     var qtdAtendendo    = <?php echo ($qtdEmAtendimento )?>;
    //var status = dados.find(d => d.STATUS.some(id=>id.STATUS=='F'));


      // Meses dos chamados em abertos
      var aJan = abertos[0];      var aFev = abertos[1];      var aMar = abertos[2];
      var aAbr = abertos[3];      var aMai = abertos[4];      var aJun = abertos[5];
      var aJul = abertos[6];      var aAgo = abertos[7];      var aSet = abertos[8];
      var aOut = abertos[9];      var aNov = abertos[10];     var aDez = abertos[11];

       // Meses dos chamados  Fechados
      var fJan = fechado[0];      var fFev = fechado[1];      var fMar = fechado[2];
      var fAbr = fechado[3];      var fMai = fechado[4];      var fJun = fechado[5];
      var fJul = fechado[6];      var fAgo = fechado[7];      var fSet = fechado[8];
      var fOut = fechado[9];      var fNov = fechado[10];     var fDez = fechado[11];

       // Meses dos chamados em Atendimento
      var eJan = atendendo[0];    var eFev = atendendo[1];    var eMar = atendendo[2];
      var eAbr = atendendo[3];    var eMai = atendendo[4];    var eJun = atendendo[5];
      var eJul = atendendo[6];    var eAgo = atendendo[7];    var eSet = atendendo[8];
      var eOut = atendendo[9];    var eNov = atendendo[10];   var eDez = atendendo[11];

         //alert('Em Março temos '+eMar+' Abertos');
     // console.log('temos '+atendendo+' Em atendimento');
      //console.log('temos '+fechado+' Fechados');

      /*
       * // O MAP faz busca no array
       var abertoMap = abertos.map((a)=>{
          //var cont = a.STATUS.length;
         // console.log(cont);
    })
       */

var ano = <?php echo date('Y');?>
      /******************** NOVO *****************************/
	/*
	Morris.Area({
        element: 'morris1',
        data: [
            {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
            {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
            {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
            {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
            {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
            {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
            {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
            {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
            {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
            {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
        ],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        hideHover: 'auto',
        lineColors: ['#8adfd0', '#6ad6c3','#22BAA0'],
        resize: true,
    });
*/
    Morris.Bar({
        element: 'morris2',
        data: [
            { period: 'Jan', a: aJan, b: fJan , c:eJan},
            { period: 'Fev', a: aFev, b: fFev , c:eFev},
            { period: 'Mar', a: aMar, b: fMar , c:eMar},
            { period: 'Abr', a: aAbr, b: fAbr , c:eAbr},
            { period: 'Mai', a: aMai, b: fMai , c:eMai},
            { period: 'Jun', a: aJun, b: fJun , c:eJun},
            { period: 'Jul', a: aJul, b: fJul , c:eJul},
            { period: 'Ago', a: aAgo, b: fAgo , c:eAgo},
            { period: 'Set', a: aSet, b: fSet , c:eSet},
            { period: 'Out', a: aOut, b: fOut , c:eOut},
            { period: 'Nov', a: aNov, b: fNov , c:eNov},
            { period: 'Dez', a: aDez, b: fDez , c:eDez},
        ],
        xkey: 'period',
        ykeys: ['a', 'b','c'],
        labels: ['Aberto', 'Fechado','Em Atendimento'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        barColors: ['#FF0000','#006400','#00008B'],
        resize: true
    });
    /*
     Morris.Line({
        element: 'morris3',
        data: [
            { year: '2006', a: 25, b: 15 },
            { year: '2007', a: 50, b: 40 },
            { year: '2008', a: 75, b: 65 },
            { year: '2009', a: 100, b: 90 },
            { year: '2010', a: 60, b: 50 },
            { year: '2011', a: 75, b: 65 },
            { year: '2012', a: 100, b: 90 }
        ],
        xkey: 'year',
        ykeys: ['a', 'b'],
        labels: ['a', 'b'],
        resize: true,
        lineColors: ['#6ad6c3','#22BAA0']
    });
    */
    Morris.Donut({
        element: 'morris4',
        data: [
            {label: 'Abertos', value: qdtAbertos },
            {label: 'Encerrados', value: qtdFechado },
            {label: 'Em Atendimento', value: qtdAtendendo },
            //{label: 'PHP', value: 20 } qdtAbertos,qtdFechado,qtdAtendendo, '#000080','#119d85','#74e4d1', '#44cbb4',
        ],
        resize: true,
        colors: [ '#FF0000','#006400','#00008B'],
    });

	/*
		google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month','Aberto', 'Encerrado', 'Em Atendimento'],
          ['Jan', aJan, fJan, eJan],
          ['Fer', aFev, fFev, eFev],
          ['Mar', aMar, fMar, eMar],
          ['Abr', aAbr, fAbr, eAbr],
          ['Mai', aMai, fMai, eMai],
          ['Jun', aJun, fJun, eJun],
          ['Jul', aJul, fJul, eJul],
          ['Ago', aAgo, fAgo, eAgo],
          ['Set', aSet, fSet, eSet],
          ['Out', aOut, fOut, eOut],
          ['Nov', aNov, fNov, eNov],
          ['Dez', aDez, fDez, eDez],

        ]);

        var options = {
          chart: {
            title: 'O.S do Ano '+ano,
            subtitle: 'Abertos, Encerrados e Em Atendimento: '+ano,
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
*/

    console.log('quantidade de Abertos é - '+qdtAbertos);
    console.log('quantidade de Fechados é - '+qtdFechado);
    console.log('quantidade de Em Atendimento é - '+qtdAtendendo);


    var ctx1 = document.getElementById("chart1").getContext("2d");
    var data1 = {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        datasets: [
            {
                label: "Fechados",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [fJan,fFev,fMar,fAbr,fMai,fJun,fJul,fAgo,fSet,fOut,fNov,fDez]
            },
            {
                label: "Abertos",
                fillColor: "rgba(34,186,160,0.2)",
                strokeColor: "rgba(34,186,160,1)",
                pointColor: "rgba(34,186,160,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(18,175,203,1)",
                data: [aJan,aFev,aMar,aAbr,aMai,aJun,aJul,aAgo,aSet,aOut,aNov,aDez]
            },
            {
                label: "Em atendimento",
                fillColor: "rgba(34,186,160,0.2)",
                strokeColor: "rgba(34,186,160,1)",
                pointColor: "rgba(34,186,160,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(18,175,203,1)",
                data: [eJan,eFev,eMar,eAbr,eMai,eJun,eJul,eAgo,eSet,eOut,eNov,eDez]
            }
        ]
    };

    var chart1 = new Chart(ctx1).Line(data1, {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

    var ctx2 = document.getElementById("chart2").getContext("2d");
    var data2 = {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
        datasets: [
            {
                label: "Fechados",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [fJan,fFev,fMar,fAbr,fMai,fJun,fJul,fAgo,fSet,fOut,fNov,fDez]
            },
            {
                label: "Abertos",
                fillColor: "rgba(34,186,160,0.2)",
                strokeColor: "rgba(34,186,160,1)",
                pointColor: "rgba(34,186,160,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(18,175,203,1)",
                data: [aJan,aFev,aMar,aAbr,aMai,aJun,aJul,aAgo,aSet,aOut,aNov,aDez]
            },
            {
                label: "Em atendimento",
                fillColor: "rgba(34,186,160,0.2)",
                strokeColor: "rgba(34,186,160,1)",
                pointColor: "rgba(34,186,160,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(18,175,203,1)",
                data: [eJan,eFev,eMar,eAbr,eMai,eJun,eJul,eAgo,eSet,eOut,eNov,eDez]
            }
        ]
    };

    var chart2 = new Chart(ctx2).Bar(data2, {
        scaleBeginAtZero: true,
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        barShowStroke: true,
        barStrokeWidth: 2,
        barDatasetSpacing: 1,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

    var ctx3 = document.getElementById("chart3").getContext("2d");
    var data3 = [
        {
            value: qdtAbertos,
            color: "#F25656",
            highlight: "#FD7A7A",
            label: "Aberto"
        },
        {
            value: qtdFechado,
            color: "#22BAA0",
            highlight: "#36E7C8",
            label: "Fechados"
        },
        {
            value: qtdAtendendo,
            color: "#F2CA4C",
            highlight: "#FBDB6E",
            label: "Em Atendimento"
        }
    ];

    var myPieChart = new Chart(ctx3).Pie(data3, {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

    var ctx4 = document.getElementById("chart4").getContext("2d");
    var data4 = [
        {
            value: 300,
            color: "#F25656",
            highlight: "#FD7A7A",
            label: "Red"
        },
        {
            value: 50,
            color: "#22BAA0",
            highlight: "#36E7C8",
            label: "Green"
        },
        {
            value: 100,
            color: "#F2CA4C",
            highlight: "#FBDB6E",
            label: "Yellow"
        }
    ];

    var myDoughnutChart = new Chart(ctx4).Doughnut(data4, {
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

    var ctx5 = document.getElementById("chart5").getContext("2d");
    var data5 = [
        {
            value: a,
            color: "#F25656",
            highlight: "#FD7A7A",
            label: "Red"
        },
        {
            value: 50,
            color: "#22BAA0",
            highlight: "#36E7C8",
            label: "Green"
        },
        {
            value: 100,
            color: "#F2CA4C",
            highlight: "#FBDB6E",
            label: "Yellow"
        },
        {
            value: 40,
            color: "#949FB1",
            highlight: "#A8B3C5",
            label: "Grey"
        }

    ];

    var myPolarArea = new Chart(ctx5).PolarArea(data5, {
        scaleShowLabelBackdrop: true,
        scaleBackdropColor: "rgba(255,255,255,0.75)",
        scaleBeginAtZero: true,
        scaleBackdropPaddingY: 2,
        scaleBackdropPaddingX: 2,
        scaleShowLine: true,
        segmentShowStroke: true,
        segmentStrokeColor: "#fff",
        segmentStrokeWidth: 2,
        animationSteps: 100,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });

    var ctx6 = document.getElementById("chart6").getContext("2d");
    var data6 = {
        labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(18,175,203,0.2)",
                strokeColor: "rgba(18,175,203,1)",
                pointColor: "rgba(18,175,203,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]
    };

    var myRadarChart = new Chart(ctx6).Radar(data6, {
        scaleShowLine: true,
        angleShowLineOut: true,
        scaleShowLabels: false,
        scaleBeginAtZero: true,
        angleLineColor: "rgba(0,0,0,.1)",
        angleLineWidth: 1,
        pointLabelFontFamily: "'Arial'",
        pointLabelFontStyle: "normal",
        pointLabelFontSize: 10,
        pointLabelFontColor: "#666",
        pointDot: true,
        pointDotRadius: 3,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });


    console.log('quantidade de Abertos é - '+qdtAbertos);
    console.log('quantidade de Fechados é - '+qtdFechado);
    console.log('quantidade de Em Atendimento é - '+qtdAtendendo);

    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    /*
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
*/
    var areaChartData = {
      labels  : ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      datasets: [
        {
          label               : 'Fechado',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [fJan,fFev,fMar,fAbr,fMai,fJun,fJul,fAgo,fSet,fOut,fNov,fDez]
        },
        {
          label               : 'Aberto',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : ['Fechado'+aJan,aFev,aMar,aAbr,aMai,aJun,aJul,aAgo,aSet,aOut,aNov,aDez]
        },
        {
          label               : 'Em Atendimento',
          backgroundColor     : 'rgba(1, 214, 222, 210)',
          borderColor         : 'rgba(1, 214, 222, 210)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [eJan,eFev,eMar,eAbr,eMai,eJun,eJul,eAgo,eSet,eOut,eNov,eDez]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
/*
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
*/
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    //var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Abertos','Fechados','Em Atendimento'],
      datasets: [
        {
          data: [qdtAbertos,qtdFechado,qtdAtendendo],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
   /*
    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
*/

// *************** PieChart Google ***********************

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Abertos',     qdtAbertos],
          ['Fechados',     qtdFechado],
          ['Em Atendimento',  qtdAtendendo]
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechartGoogle'));

        chart.draw(data);
      }

})


/*********************** FIM GERA GRAFICOS **************************/
</script>



		<!-- /.content-wrapper -->
		<footer align="center" class="main-footer">
			<strong>Copyright &copy; <?php echo e($anoCorrente); ?> <a
				href="#">Grau Certo</a>.
			</strong>

			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 1.0.0
			</div>
		</footer>

</body>
</html>

<?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/graficos-demandas.blade.php ENDPATH**/ ?>