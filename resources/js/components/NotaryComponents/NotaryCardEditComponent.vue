<template>
    <div>
        <div class="page-heading " id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Редактирование нотариуса</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="callback-form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <div id="preview" class="mb-3">
                                                <img v-if="new_image" v-model="new_image" :src="new_image"/>
                                            </div>
                                            <input type="file"
                                                   class="input-image
                                                   col-lg-7 col-md-7
                                                   col-sm-12 offset-lg-4
                                                   offset-md-4 offset-sm-0"
                                                   accept="/*"
                                                   @change="onFileChange($event)"/>
                                        </fieldset>
                                        <fieldset>
                                            <label for="fio" class="text-white h4 float-left mb-2">
                                                ФИО нотариуса:
                                            </label>
                                            <input name="fio" type="text" v-model="new_fio" class="form-control"
                                                   id="fio">
                                        </fieldset>
                                        <fieldset>
                                            <label for="description" class="text-white h4 float-left mb-2">
                                                Описание:
                                            </label>
                                            <input name="description" type="text" v-model="new_desc"
                                                   class="form-control"
                                                   id="description">
                                        </fieldset>
                                        <fieldset>
                                            <label for="address" class="text-white h4 float-left mb-2">
                                                Адрес офиса:
                                            </label>
                                            <input name="address" type="text" v-model="new_address" class="form-control"
                                                   id="address">
                                        </fieldset>
                                        <fieldset>
                                            <label for="qualification" class="text-white h4 float-left mb-2">
                                                Квалификация:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="qualification"
                                                    id="qualification"
                                                    v-model="new_qualif">
                                                <option v-for="item in qualifications" :value="item.id">
                                                    {{ item.name }}
                                                </option>
                                            </select>
                                        </fieldset>
                                        <fieldset>
                                            <p class="text-white h4 float-left mb-2">
                                                Расписание:
                                            </p>
                                        </fieldset>
                                        <div style="overflow-x:auto">
                                            <table class="table">
                                                <tr class="table-header">
                                                    <th>
                                                        <!--empty cell-->
                                                    </th>
                                                    <template v-for="hour in hours">
                                                        <th class="h5 text-white font-weight-bold">
                                                            {{ hour }}
                                                        </th>
                                                    </template>
                                                </tr>
                                                <template v-for="(day, index) in days">
                                                    <tr>
                                                        <td class="h5 text-white font-weight-bold"> {{ day }}</td>
                                                        <template v-for="ind in 8">
                                                            <td>
                                                                <input type="checkbox"
                                                                       @change="changeData(index, ind-1, $event)"
                                                                       :checked="new_schedule[index][ind-1] === 1 || new_schedule[index][ind-1] === -1"
                                                                       :disabled="new_schedule[index][ind-1] === -1"/>
                                                            </td>
                                                        </template>
                                                    </tr>
                                                </template>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="border-button mt-1" @click.prevent="count()">Сохранить
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        let notary = {
            id: 0,
            fio: 'Субботин Валерий Степанович',
            image: '',
            qualification_id: 2,
            office_address: 'ул. Промышленная, 29А',
            description: 'Высококлассный специалист, со стажем работы в 10 лет.',
            schedule: [
                // 6 строк (пн - сб), 12 столбцов (11:00 - 18:00)
                // 1 - принимает, 0 - не принимает, -1 - вынужденный приём (есть запись)
                [-1, 0, -1, 1, 1, 1, -1, 0],
                [1, 1, -1, 1, 0, 0, -1, 0],
                [1, 1, 0, 1, 0, 1, -1, 0],
                [0, 1, 0, 1, -1, 0, -1, 0],
                [1, 0, 0, 1, 0, -1, 0, 0],
                [1, 1, -1, 0, 1, 0, 0, 1]
            ]
        };
        let qualifications = [
            {
                id: 0,
                name: 'Средняя квалификация',
                coefficient: 1
            },
            {
                id: 1,
                name: 'Высшая квалификация',
                coefficient: 1.25
            },
            {
                id: 2,
                name: 'Наивысшая квалификация',
                coefficient: 1.5
            }
        ];
        let days = 'ПН|ВТ|СР|ЧТ|ПТ|СБ'.split('|');
        let hours = [ '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
        return {
            notary,
            new_fio: '',
            new_image: '',
            new_qualif: null,
            new_schedule: null,
            new_address: '',
            new_desc: '',
            remoteUrl: '',
            qualifications,
            days,
            hours,
            array: []
        }
    },
    methods: {
        count() {
            console.log(this.array)
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.new_image = URL.createObjectURL(file);
            this.createBase64Image(e);
        },
        createBase64Image(element) {
            let file = element.target.files[0];
            //console.log(file);
            let reader = new FileReader();
            reader.onloadend = function() {
                this.new_image =  reader.result;
                console.log(this.new_image);
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        },
        uploadPhoto() {
            //const { new_image } = this;
            // axios.post('/api/v1/someUrl', { new_image }) {
            // .then((response) => {
            // this.remoteUrl = response.data.url;
            //})
            //.catch((err) => {
            // return new Error(err.message)
            // })
        },
        changeData(i, j, e) {
            if (e.target.checked) {
                this.new_schedule[i][j] = 1;
            }
            else {
                this.new_schedule[i][j] = 0;
            }
            console.log(this.new_schedule);
        }
    },
    computed: {},
    mounted() {
        window.scrollTo(0, 0)
    },
    created() {
        const notaryId = this.$route.params.id;

        this.new_fio = this.notary.fio;
        this.new_image = this.notary.image;
        this.new_desc = this.notary.description;
        this.new_address = this.notary.office_address;
        this.new_schedule = this.notary.schedule;
        this.new_qualif = this.notary.qualification_id;
        /*
       axios.get(`/api/v1/subcategories/${subCatId}`).then(response => {
           // if (response.data.status === 200)
           this.subcategory = response.data;
           console.log(response);
           // if (response.data.status === 404)
           router.push('/404')
           //
       }); на будущее */
    },
}
</script>

<style scoped>
.text-style {
    text-transform: none !important;
}

#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 500px;
}

.rounded-select {
    border-radius: 10px;
    height: 40px;
    line-height: 40px;
    display: inline-block;
    padding: 0px 15px;
    color: #6a6a6a;
    font-size: 18px;
    text-transform: none;
    box-shadow: none;
    border: none;
    margin-bottom: 35px;
}

.back-light {
    border-radius: 20px;
    background-color: #fdf8f8;
    font-weight: bold;
}

img {
    width: 150px;
    height: 150px;
    border-radius: 80px;
}

.input-image {
    background-color: transparent;
    font-size: 14px !important;
    text-transform: uppercase;
    display: inline-block;
    transition: all 0.3s;
    height: 30px !important;
    line-height: 20px !important;
}

input[type=checkbox] {
    width: 30px;
    height: 30px;
}

@media (max-width: 768px) {
    input[type=checkbox] {
        width: 20px;
        height: 20px;
    }
}

table {
    background-color: rgb(60, 105, 122, 0.5) !important;

}

</style>
