const { createApp, ref, reactive, onMounted } = Vue
const Swal = SweetAlert

createApp({
    setup() {

        /* Recivimos los datos del formulario */
        let datos = reactive({
            name: '',
            description: '',
            price: '',
            idCayegory: '',
            idSub_category: '',
            code: ''
        })

        const selectSubcategory = ref(false)
        const comfrinCode = ref(false)
        const comfrimData = ref(false)
        const selectAll = ref(false)
        let data = reactive({
            subCategoryData: null,
            category: null
        })

        let info = reactive({
            dataTable: null,
            selected: [],

        })

        let dataTable = reactive({
            id: ''
        })

        //LLenar select

        const getSelect = () => {

            let form = new FormData();

            for (dato in datos) {
                form.append(dato, datos[dato])

            }

            axios.post('./php/selectData.php', form)
                .then((res) => {

                    data.subCategoryData = res.data

                    if (Object.keys(data.subCategoryData).length > 0) {
                        selectSubcategory.value = true
                    }
                })
        }

        const getSelect2 = () => {

            axios.get('./php/selectData2.php')
                .then((res) => {
                    data.category = res.data
                })
        }


        /* Guardar Productos en la bd */
        const saveProduct = () => {

            let form = new FormData();

            for (dato in datos) {
                form.append(dato, datos[dato])

            }

            comfrinCode.value = false

            axios.post('./php/saveProducts.php', form)
                .then((res) => {
                    Swal.fire({
                        title: 'Datos Enviados',
                        icon: 'success'
                    })
                    comfrimData.value = true
                    getproducts()
                    ClearData()
                })


        }


        const getproducts = () => {
            axios.get('./php/getProducts.php')
                .then((res) => {
                    info.dataTable = res.data
                    if (info.dataTable.length > 0) {
                        comfrimData.value = true
                    }

                })
        }

        const select = (e) => {

            info.selected = []
            if (!document.getElementById("hola").checked) {
                info.selected = []

            } else {
                for (let i = 1; i <= info.dataTable.length; i++) {
                    info.selected.push(i.toString())

                }
            }
            //console.log(e.checked)
            //selectAll.value = !selectAll.value
            //console.log(selectAll.value)
            //info.selected = []


            console.log(document.getElementById("hola").checked)


        }

        const selectallfalse = () => {
            selectAll.value = document.getElementById("hola").checked = false

        }

        const generarCodebar = () => {
            
            let dataProducts = []

            if (info.selected.length == 0) {
                Swal.fire({
                    title: 'Tienes que selecionar al menos un producto',
                    icon: 'warning'
                })
            } else {
                for (let i = 0; i < info.selected.length; i++) {

                    for (let j = 0; j < info.dataTable.length; j++) {

                        if (info.selected[i] == info.dataTable[j].id) {
                            dataProducts.push(info.dataTable[j]) 
                        }

                    }
                }
                
             console.log(dataProducts)
            
            }


        }

        /* generar codigo */
        const generateCode = (num) => {
            const characters = '0123456789';
            let result1 = '';
            const charactersLength = characters.length;
            for (let i = 0; i < num; i++) {
                result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            datos.code = result1

            comfrinCode.value = true
        }

        const ClearData = () => {
            Object.assign(datos, {
                name: '',
                description: '',
                price: '',
                idCayegory: '',
                idSub_category: '',
                code: ''
            })

            Object.assign(data, {
                subCategoryData: ''
            })

            selectSubcategory.value = false

        }

        onMounted(() => {
            getSelect2()
            getproducts()
        })


        return {
            getSelect,
            datos,
            data,
            selectSubcategory,
            saveProduct,
            comfrinCode,
            generateCode,
            info,
            getproducts,
            select,
            dataTable,
            generarCodebar,
            comfrimData,
            selectAll,
            selectallfalse

        }

    }


}).mount('#app')