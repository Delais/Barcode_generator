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
        const comfrinData = ref(true)

        let data = reactive({
            subCategoryData: null
        })

        let info = reactive({
            dataTable: null
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


        /* Guardar Productos en la bd */
        const saveProduct = () => {

            let form = new FormData();

            for (dato in datos) {
                form.append(dato, datos[dato])

            }

            comfrinCode.value = false

            axios.post('./php/saveProducts.php', form)
                .then((res) => {
                    console.log(res)
                     Swal.fire({
                        title: 'Datos Enviados',
                        icon: 'success'
                    }) 
                    getproducts()
                    ClearData()
                })
        }

        
         const getproducts = () => {
            axios.get('./php/getProducts.php')
            .then((res)=>{
                console.log(res)
                elements = res.data
                info.dataTable = elements
                console.log(info.dataTable)                
            })
        }

         onMounted(() => {
       
            getproducts()
            
        })
       

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

        return {
            getSelect,
            datos,
            data,
            selectSubcategory,
            saveProduct,
            comfrinCode,
            generateCode,
            info,
            comfrinData,
            getproducts
            
        }

    }

    
}).mount('#app')