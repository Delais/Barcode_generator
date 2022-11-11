<?php
include_once('./php/connection.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>

<body>

    <div id="app">

        <form action="" method="post">

            <select name="category" id="categorySelect" autofocus @change="getSelect" v-model="datos.idCayegory">
                <option value="" selected="true" disabled>--Please select a category--</option>


                <?php
                $query = "SELECT `id`,`name` FROM `category`";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    echo '--ERROR CONNECT--';
                    return;
                } else {
                    while ($values = mysqli_fetch_array($result)) {
                        echo '<option value="' . $values['id'] . '">' . $values['name'] . '</option>';
                    }
                }
                ?>

            </select>

            <select name="subCategory" id="subCategorySelect" v-if="selectSubcategory"
            v-model="datos.idSub_category"
            >
                <option value="" selected="true" disabled>--Please select a category--</option>
                <option v-for=" item in data.subCategoryData" :value="item.id">
                    {{ item.name }}
                </option>
            </select>

            <input type="text" placeholder="name product" name="product_name" v-model="datos.name">

            <input type="number" placeholder="price product" name="product_price" v-model="datos.price">

            <textarea name="product_description" id="" cols="30" rows="10" v-model="datos.description"></textarea>
            
            <input type="button" value="Generar" @click="generateCode(19)" v-if="!comfrinCode">

            <input type="text" disabled v-model="datos.code">

            <input type="button" value="Guardar" @click="saveProduct" v-if="comfrinCode">

        </form>


    <div>
    <table>
        <tr>
            <th>name</th>
            <th>price</th>
            <th>description</th>
            <th>code</th>
        </tr>
        <tr v-for=" item in info.dataTable ">
            <td>{{ item.name }}</td>
            <td>{{item.price}}</td>
            <td>{{item.description}}</td>
            <td>{{item.code}}</td>
        </tr>
        </table>
        
    </div>
    </div>
    <script src="./asset/js/index.js"></script>
</body>

</html>