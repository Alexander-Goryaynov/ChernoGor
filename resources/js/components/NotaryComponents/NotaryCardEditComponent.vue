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
                                            <button type="submit" id="form-submit" class="border-button mt-1" @click.prevent="submit()">Сохранить
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
import Swal from "sweetalert2";

export default {
    data() {
        let notary = [];
        let qualifications = [
        ];
        let days = 'ПН|ВТ|СР|ЧТ|ПТ|СБ'.split('|');
        let hours = [ '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
        return {
            new_fio: '',
            new_image: '',
            new_qualif: null,
            new_schedule: [
                [0, 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0, 0]
            ],
            new_address: '',
            new_desc: '',
            notary,
            qualifications,
            days,
            hours,
            error_message: '',
        }
    },
    methods: {
        submit() {
            if (!this.new_fio || !this.new_image || !this.new_qualif || !this.new_address || !this.new_desc) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Заполните все поля',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
            else if (this.notary.fio === this.new_fio && this.notary.photo === this.new_image
                && this.notary.description === this.new_desc && this.notary.office_address === this.new_address) {
                    const notaryId = this.$route.params.id;
                    axios.get(`/api/v1/notaries/${notaryId}/edit`).then(response => {
                       if (response.data.schedule === this.new_schedule) {
                            Swal.fire({
                                title: 'Ошибка',
                                text: 'Данные должны отличаться',
                                icon: 'error',
                                confirmButtonText: 'Ок'
                            });
                       }
                       else {
                             this.updateNotary();
                       }
                    }).catch(function (error) {
                        Swal.fire({
                            title: 'Ошибка',
                            text: 'Что-то пошло не так',
                            icon: 'error',
                            confirmButtonText: 'Ок'
                        });
                    });
            }
            else {
                this.new_fio = this.new_fio.trim();
                if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.new_fio))) {
                    this.error_message += "ФИО должно содержать только буквы. \n";
                }
                if ((this.new_fio.length) < 5 || (this.new_fio.length) > 50) {
                    this.error_message += "ФИО должно содержать более 5 и менее 50 символов. \n";
                }
                if ((this.new_desc.length) < 10 || (this.new_desc.length) > 50) {
                    this.error_message += "Описание должно содержать более 10 и менее 50 символов. \n";
                }
                if ((this.new_address.length) < 10 || (this.new_address.length) > 50) {
                    this.error_message += "Адрес должен содержать более 10 и менее 50 символов. \n";
                }
                if (this.error_message) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: this.error_message,
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    })
                    this.error_message = '';
                } else {
                   this.updateNotary();
                }
            }
        },
        updateNotary() {
            axios.put('/api/v1/notaries/' + this.$route.params.id,
                    {
                        "fio": this.new_fio,
                        "description": this.new_desc,
                        "photo": this.new_image,
                        "office_address": this.new_address,
                        "qualification_id": this.new_qualif,
                        "schedule": this.new_schedule
                    }).then(response => {
                    Swal.fire({
                        title: 'Успех',
                        text: 'Нотариус изменен успешно',
                        icon: 'success',
                        confirmButtonText: 'Ок'
                    });
                    this.$router.push('/notaries')
                }).catch(function (error) {
                    if (error.response) {
                        Swal.fire({
                            title: 'Ошибка',
                            text: 'Невозможно изменить нотариуса',
                            icon: 'error',
                            confirmButtonText: 'Ок'
                        });
                    }
                });
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.new_image = URL.createObjectURL(file);
            this.createBase64Image(e);
        },
        createBase64Image(element) {
            let image = element.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e =>{
                this.new_image = e.target.result;
            };
        },
        changeData(i, j, e) {
            if (e.target.checked) {
                this.new_schedule[i][j] = 1;
            }
            else {
                this.new_schedule[i][j] = 0;
            }
        }
    },
    computed: {},
    mounted() {
        window.scrollTo(0, 0)
    },
    created() {
        const notaryId = this.$route.params.id;

        axios.get(`/api/v1/qualifications/select`).then(response => {
            this.qualifications = response.data.qualifications;
        }).catch(function (error) {
            if (error.response) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Невозможно загрузить квалификации',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
        });

        axios.get(`/api/v1/notaries/${notaryId}/edit`).then(response => {
            this.notary = response.data;
            this.new_fio = response.data.fio;
            this.new_image = response.data.photo;
            this.new_desc = response.data.description;
            this.new_address = response.data.office_address;
            this.new_schedule = response.data.schedule;
            this.new_qualif = response.data.qualification_id;
        }).catch(function (error) {
            if (error.response) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Невозможно создать нотариуса',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
        });
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
