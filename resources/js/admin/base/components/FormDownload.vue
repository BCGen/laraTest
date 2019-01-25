<template>
  <div class="container">
    <v-app>
      <form
        method="POST"
        action="/admin/form_download"
        enctype="multipart/form-data"
        @submit.prevent="onSubmit">

        <input
          type="file"
          name="file"
          @change="getFile($event)">
        <v-btn>Save file</v-btn>
      </form>

      <v-data-table
        :headers="headers"
        :items="list"
        class="elevation-1"
      >
        <template
          slot="items"
          slot-scope="props">
          <td>{{ props.item.file_name }}</td>
          <td class="text-center">
            <v-btn
              outline
              color="error"
              small
              dark>
              <v-icon>close</v-icon>
              DELETE
            </v-btn>
          </td>
        </template>
      </v-data-table>

    </v-app>
  </div>
</template>

<script>
export default {
  name: 'FormDownload',
  props: ['list'],
  data () {
    return {
      file: '',
      headers: [
        {
          text: 'Form Name',
          align: 'left',
          value: 'name'
        },
        {
          text: 'Action',
          align: 'center',
          sortable: false
        }
      ]
    }
  },
  methods: {
    getFile(e) {
      this.file = e.target.files
    },
    onSubmit() {
      let formData = new FormData()
      formData.append('fileUrl', this.file[0])
      formData.set('fileName', this.file[0].name)

      axios.post('/admin/form_download', formData)
        .then(response => {
          window.location.href = '/admin/form_download'
        })
    }
  }
}
</script>
