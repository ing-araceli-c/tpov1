<html>
<head>
   <link href='css/style.css' rel='stylesheet' type='text/css'>
   <link href='css/facebox.css' rel='stylesheet' type='text/css'>
   <meta charset='utf-8'>
</head>
<body class='container'>
    <div>
      <div class='top_nav span12'>
        <p>
          <div class='summary hidden'>
            <ul class='yearly_summary'>
              <li class='summary_year'></li>
              <li class='summary_receipts'></li>
              <li class='summary_expenses'></li>
              <li class='summary_net'></li>
            </ul>
          </div>
        </p>
      </div>
      <div class='year_picker span12'>
        <ul>
          <li class='year'>2013</li>
          <li class='year'>2014</li>
          <li class='year'>2015</li>
          <li class='year'>2016</li>
        </ul>
      </div>
      <div class='clear'></div>

      <div class='backtrace span12'>
        <ul>
          <li class='agency'></li>
          <li class='bureau'></li>
        </ul>
      </div>
      <div class='chart_control span8 hidden'>
        <p class='chart_instructions'>
          Hacer click para grafica, y doble click para mas detalle.
        </p>
        <ul class='type_chooser state_chooser'>
          <li class='chooser expense_chooser active'>Campaña</li>
          <li class='chooser receipts_chooser'>Aviso</li>
        </ul>
        <ul class="capita_chooser_list state_chooser">
          <li class="capita_chooser active">Total</li>
          <li class="capita_chooser">Por Sujeto Obligado</li>
        </ul>
        <ul class='inflation_chooser state_chooser'>
          <li class='currency_chooser normal_currency active'>Por Proveevor</li>
          <li class='currency_chooser inflation_adjusted'>Por Tipo de Servicio</li>
        </ul>
      </div>
      <div class='clear'></div>
      <div class='span12' id='chart'></div>
<center>
      <div class='toggle_section hidden'>
        <ul>
          <li class='show_list'>Mostrar Lista</li>
          <li class='hide_list hidden'>Esconder Lista</li>
        </ul>
      </div>
      <table class='expenses expense_table hidden'>
      </table>
    </div>
</center>
    <script src='js/jquery-1.9.1.min.js' type='text/javascript'></script>
    <script src='js/d3.v3.min.js' type='text/javascript'></script>
    <script src='js/underscore-min.js' type='text/javascript'></script>
    <script src='js/facebox.js' type='text/javascript'></script>
    <script src='js/budget.js' type='text/javascript'></script>
</body>
</html>

