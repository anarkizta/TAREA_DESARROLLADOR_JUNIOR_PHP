<!DOCTYPE html>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$hoy = date('d-m-Y', time());
?>
<html>


<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css" media="screen,projection" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- -->

</head>

<body>
    <main>
        <div class="row">
            <div class="container">
                <div class="row">
                    <ul class="collapsible">
                        <li>
                            <div class="collapsible-header  red lighten-1">
                                <i class="large material-icons">info_outline</i>
                                Indicadores Hoy <?php echo $hoy ?>
                            </div>
                            <div class="collapsible-body red lighten-3">
                                <div class="row">
                                    <div class="col l4" v-for="i in InfoInd">
                                        <div class="card-panel hoverable " v-if="i.codigo != null">
                                            <div class="center-align">
                                                <u><strong>{{i.nombre}}</strong></u>
                                                <br>
                                                <table class="centered">
                                                    <thead>
                                                        <tr>
                                                            <th>Valor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="red-text" v-if="i.unidad_medida == 'Pesos'">
                                                                $ {{i.valor}}</td>
                                                            <td class="red-text" v-if="i.unidad_medida == 'Porcentaje'">
                                                                {{i.valor}} %
                                                            </td>
                                                            <td class="red-text" v-if="i.unidad_medida == 'Dólar'">
                                                                US $ {{i.valor}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="active">
                            <div class="collapsible-header light-blue">
                                <i class="large material-icons">equalizer</i>
                                Graficos (por rango de fecha)
                            </div>
                            <div class="collapsible-body light-blue lighten-4">
                                <div class="row">
                                    <div id="btn" class="col l12 card-panel">
                                        <div class="row">
                                            <div class="col l3">
                                                <label for="start">Inicio</label>
                                                <input type="date" id="start">
                                            </div>
                                            <div class="col l3">
                                                <label for="start">Fin</label>
                                                <input type="date" id="end">
                                            </div>
                                            <div class="col l3">
                                                <p>
                                                    <label>Indicador</label>
                                                    <select id="cod" class="browser-default">
                                                        <option value="uf">Unidad de Fomento (UF)</option>
                                                        <option value="ivp">Indice de valor promedio (ivp)</option>
                                                        <option value="dolar">Dólar observado</option>
                                                        <option value="dolar_intercambio">Dólar acuerdo</option>
                                                        <option value="euro">Euro</option>
                                                        <option value="ipc">Indice de Precios al Consumidor (IPC)</option>
                                                        <option value="utm">Unidad Tributaria Mensual (UTM)</option>
                                                        <option value="imacec">Imacec</option>
                                                        <option value="tpm">Tasa Política Monetaria</option>
                                                        <option value="libra_cobre">Libra de Cobre</option>
                                                        <option value="tasa_desempleo">Tasa de desempleo</option>
                                                        <option value="bitcoin">Bitcoin</option>
                                                    </select>
                                                  
                                                <p>

                                            </div>
                                            <div class="col l3 right-align"><br>
                                                <button onclick="cargarGrafico()" class="btn right-align waves-effect waves-light red" name="action">Generar
                                                    <i class="material-icons right">equalizer</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="graficar" class="col l12 ">
                                        <div class="row card-panel">
                                            <div>

                                                <div>
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header teal">
                                <i class="large material-icons">mode_edit</i>
                                CRUD Unidades de Fomento (ultimos 30 dias)
                            </div>
                            <div class="collapsible-body  teal lighten-3">
                                <div class="row">
                                    <div class="col l6" v-for="uf in InfoUF.serie">
                                        <div class="card-panel hoverable">
                                            <div class="center-align">
                                                <u><strong>Unidad de Fomento</strong></u>
                                                <br>
                                                <table class="centered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Valor $</th>
                                                            <th>Agregar Valor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="red-text">
                                                                {{uf.fecha.slice(0,10)}}
                                                            </td>
                                                            <td class="red-text">
                                                                {{Math.round(uf.valor)}}
                                                            </td>
                                                            <td>
                                                                <button class="btn-floating btn-small waves-effect waves-light blue" @click="cargaModal(uf)">
                                                                    <i class="material-icons">add</i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <li>
                            <div class="collapsible-header light-green">
                                <i class="large material-icons">search</i>
                                UF Modificados
                            </div>
                            <div class="collapsible-body  light-green lighten-4">

                                <div class="row">
                                    <div class="col l6" v-for="i in InfoUFMod">
                                        <div class="card-panel">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col l6">
                                                        <h5 class="center-align">UF Original</h5>
                                                        <table class="centered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Valor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="red-text">
                                                                        {{i.fec_ori}}
                                                                    </td>

                                                                    <td class="red-text"> $ {{i.val_ori}} </td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="col l6">
                                                        <h5 class="center-align">UF Modificada</h5>
                                                        <table class="centered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Fecha</th>
                                                                    <th>Valor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="red-text">{{i.fec_mod}} </td>

                                                                    <td class="red-text"> $ {{i.val_mod}} </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col l12 right-align">
                                                            <button @click="cargaModal2(i)" class=" btn-floating btn-small waves-effect waves-light blue">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button @click="eliminarUF(i)" class=" btn-floating btn-small waves-effect waves-light red">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal">
            <div class="modal-content">
                <h3 class="center-align">Valor UF</h3>
                <br><br>
                <div class="row">
                    <div class="input-field col s12">
                        <h5>
                            <strong v-if="!estadoModal">FECHA ENTRADA {{a_fecha }}</strong>
                            <strong v-else>FECHA ENTRADA {{modUF.fec_ori}}</strong>

                        </h5>
                    </div>
                    <div class="input-field col s6">
                        <h5>
                            <strong v-if="!estadoModal">VALOR ORIGINAL ${{a_valor}}</strong>
                            <strong v-else>VALOR ORIGINAL ${{modUF.val_ori}}</strong>
                        </h5>
                    </div>
                </div>
                <div class="divider"></div>
                <h5 class="center-align">Registrar Nuevo valor</h5>
                <br><br>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" v-model="valor" placeholder="Ingrese un nuevo Valor" type="text" class="validate">
                        <label for="first_name" class="black-text">Nuevo Valor</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn waves-effect waves-light red" @click="cerrarModal()" name="action">Cerrar
                    <i class="material-icons right">close</i>
                </button>
                <button v-if="!estadoModal" class="btn waves-effect waves-light blue" @click="agregarUF()" name="action">Crear
                    <i class="material-icons right">add</i>
                </button>
                <button v-else class="btn waves-effect waves-light blue" @click="editarUF()" name="action">Actualizar
                    <i class="material-icons right">edit</i>
                </button>
            </div>
        </div>
        <pre>
        {{$data}}
        </pre>

    </main>
    <!-- vue.chartjs importaciones -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/materialize.min.js"></script>
    <!-- script conexion con vue.js -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- script conexion con axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- script conexion con manipulacionDatos.js en assets/js -->
    <!--importacion para mensajes pop-up sweet-alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="<?= base_url() ?>assets/js/manipulacionDatos.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/grafico.js" type="text/javascript"></script>


</body>

</html>