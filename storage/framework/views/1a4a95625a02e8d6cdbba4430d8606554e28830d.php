

    <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário <?php echo date('Y'); ?></title>
     <!-- Add CSS Agena -->
      <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/evo-calendar.min.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/evo-calendar.royal-navy.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/evo-calendar.orange-coral.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/\evo-calendar.midnight-blue.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/button.css')); ?>">
      <!-- Logo pequeno  -->
    <link rel="shortcut icon" href="<?php echo e(asset('imagens/grau_certo_logo.jpg')); ?>">
      
</head>
    <body>
    <div class="hero">
        <div id="calendar"></div>
        <!--<a href="admin/" class="myButton">Login</a>-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <script src="<?php echo e(asset('js/evo-calendar.min.js')); ?>"></script>
    <script>
        // Initialize evo-calendar in your script file or an inline <script> tag
        $(document).ready(function() {
		var dados = <?php echo $agenda;?>;
		dados.forEach(function(dado) {
            console.log(dado.titulo)
         })
        	//console.log(dados[1].titulo)
            $('#calendar').evoCalendar({
                //theme: 'Royal Navy',
                //theme: 'Orange Coral',
                theme: 'Midnight Blue',
                language: 'pt',
                format: "MM dd, yyyy",
                titleFormat: "MM",
                calendarEvents: [
                    <?php
                    
                    foreach ($agenda as $value) {
                        if($value->cor == 'V'){
                            $cor = '#FF0000';
                        }elseif($value->cor == 'A'){
                            $cor = '#FFFF00';
                        }else{
                            $cor = '#006400';
                        }

                    ?> {
                            id: "<?php echo htmlentities($value->id_agenda)?>",
                            name: "<?php echo htmlentities($value->titulo) ?>",
                            date: ["<?php echo htmlentities(date('d/F/Y',strtotime($value->data_agenda,))) ?>"], // Date range
                            description: "<?php echo htmlentities($value->descricao) ?>", // Event description (optional)
                            type: "event",
                            /*color: "#63d867" */

                            color: "<?php echo htmlentities($cor)?>" // Event custom color (optional)
                        },

                    <?php } ?> {
                        id: "event1",
                        name: "Elcinei Saldanha",
                        badge: "10h", // Event badge pode ser o horario
                        date: ["1 apr,2023"], // Date range
                        description: "#", // Event description (optional)
                        type: "event",
                        color: "#63d867" // Event custom color (optional)
                    }
                ]
            })
        })
    </script>

<?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/agenda-demanda.blade.php ENDPATH**/ ?>