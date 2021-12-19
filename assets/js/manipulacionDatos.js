new Vue({
    el: 'main',
    data: {
        start_date: "",
        end_date: "",
        a_valor: "",
        a_fecha: "",
        valor: "",
        fecha: "",
        estadoModal: false,
        msg: {},
        info: [],
        FiltroCodigo: [],
        InfoUF: [],
        InfoInd: [],
        modUF: [],
        antiguaUF: [],
        InfoUFMod: [],
        //datos qiue recibe desde la pagina.php
    },
    created: function ()
    {
        // metodos que se deben inicicializan con la pagina.php
        this.cargaIndicadores();
        this.cargaUf();
    },
    mounted: function ()
    {
        //importaciones que debe poseer la pagina.php para uso de combobox y chk modal ... 
        M.AutoInit();

    },
    methods: {
        // creacion de metodos para funcionalidad, etc... 
        cargaIndicadores: function ()
        {

            // in
            url_Ind = 'https://mindicador.cl/api';
            axios.get(url_Ind).then(resp =>
            {
                this.InfoInd = resp.data;
            }).catch(error =>
            {
                console.log(error);
            });

            url = "http://localhost/TAREA_DESARROLLADOR_JUNIOR_PHP/index.php/VerUfj";
            axios.post(url).then(resp =>
            {
                this.InfoUFMod = resp.data;
            }).catch(error =>
            {
                console.log(error);
            });

        },
        cargaUf: function ()
        {
            let urlsF = "https://mindicador.cl/api/uf";

            axios.get(urlsF).then(resp =>
            {
                this.InfoUF = resp.data;
            }).catch(error =>
            {
                console.log(error);
            });
        },
        cargaModal: function (x)
        {
            this.valor = "";
            this.estadoModal = false;
            var instance = M.Modal.getInstance(document.querySelector('.modal'));
            instance.open();
            if (!this.estadoModal)
            {
                this.antiguaUF = x;
                this.a_fecha = this.antiguaUF.fecha.slice(0, 10);
                this.a_valor = Math.round(this.antiguaUF.valor);
            }

        },
        cargaModal2: function (x)
        {
            this.estadoModal = true;
            if (this.estadoModal)
            {
                var instance = M.Modal.getInstance(document.querySelector('.modal'));
                instance.open();
                this.modUF = x;
                this.valor = this.modUF.val_mod;
            }
        },
        editarUF: function ()
        {
            urlUpdm = "http://localhost/TAREA_DESARROLLADOR_JUNIOR_PHP/index.php/ActUfM";
            Id = new FormData();
            Id.append("id", this.modUF.Id_mod);
            Id.append("valor", this.valor);

            axios.post(urlUpdm, Id).then(resp =>
            {
                this.msg = resp.data;
                this.cargaIndicadores();
                swal({
                    title: "Modificado!",
                    text: this.msg.msg,
                    icon: "success",
                });
            }).catch(error =>
            {
                console.log(error);
            });
            var instance = M.Modal.getInstance(document.querySelector('.modal'));
            instance.close();
        },
        eliminarUF: function (i)
        {
            url = "http://localhost/TAREA_DESARROLLADOR_JUNIOR_PHP/index.php/EliminarUFMod";
            Ids = new FormData();
            Ids.append("id_mod", i.Id_mod);
            Ids.append("id_ori", i.Id_original);
            swal({
                title: "¿Estas seguro de eliminar?",
                text: "Los datos se eliminaran sin recuperacion alguna!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) =>
                {
                    if (willDelete)
                    {
                        swal("Poof! Tus datos imaginarios han sido eliminados!", {
                            icon: "success",
                        });
                        axios.post(url, Ids)
                            .then(resp =>
                            {
                                this.msg = resp.data;
                                this.cargaIndicadores();
                                this.cerrarModal();
                            }).catch(error =>
                            {
                                console.log(error);
                            });
                    } else
                    {
                        swal("Buena decision, no has eliminado nada!");
                    }
                });
        },
        agregarUF: function ()
        {
            url = "http://localhost/TAREA_DESARROLLADOR_JUNIOR_PHP/index.php/AgUfO";
            uf = new FormData();
            uf.append("fecha", this.a_fecha);
            uf.append("valor", this.a_valor);
            uf.append("valor_m", this.valor);
            var instance = M.Modal.getInstance(document.querySelector('.modal'));
            instance.close();
            axios.post(url, uf).then(resp =>
            {
                this.msg = resp.data;
                this.cargaIndicadores();
                swal({
                    title: "Gestionado!",
                    text: this.msg.msg,
                    icon: "success",
                });

            }).catch(
                error =>
                {
                    console.log(error);
                });

        },
        cerrarModal: function ()
        {
            var instance = M.Modal.getInstance(document.querySelector('.modal'));
            instance.close();
        },
        test: function ()
        {
        }
    }
})

