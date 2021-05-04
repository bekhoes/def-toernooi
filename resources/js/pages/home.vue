<template>
  <div class="w-full h-full flex">
    <div class="w-1/2 mx-auto">
      <form class="bg-gray-300 p-4 rounded-xl" @submit.prevent="save">
        <label>Team</label>
        <select v-model="pickedTeam" class="w-full form-select">
          <option v-for="team in teams" :key="team.id" :value="team.id" class="p-2">{{ team.id }} | {{ team.name }}</option>
        </select>
        <label>Kills</label>
        <input type="number" v-model="kills" class="form-input w-full">
        <label>Graphics Cards</label>
        <input type="number" v-model="gpus" class="form-input w-full">
        <label>Ledx's</label>
        <input type="number" v-model="ledx" class="form-input w-full"><br>
        <label>
          <input type="checkbox" v-model="bosskill" class="form-checkbox">
          Killa Gekilled
        </label><br><br>
        <button class="p-2 bg-teal-600 text-white mt-2 rounded">Opslaan</button>
      </form>
    </div>
  </div>
</template>

<script>
import Axios from 'axios'
import Swal from 'sweetalert2'

export default {
  middleware: 'auth',

  data: () => ({
    title: window.config.appName,
    teams: {},
    pickedTeam: null,
    kills: 0,
    bosskill: false,
    gpus: 0,
    ledx: 0
  }),
  metaInfo () {
    return { title: this.$t('home') }
  },
   methods: {
    getTeams () {
      const self = this
      Axios.get('/api/teams').then(function (response) {
        self.teams = response.data
      })
    },
    save () {
      const self = this
      if (self.pickedTeam == null) {
        Swal.fire({
          title: 'Niet gelukt..',
          text: 'U heeft geen team opgegeven',
          type: 'error'
        })
        return
      } 
      Axios.post('/api/raid', {
        team: self.pickedTeam,
        kills: self.kills,
        bosskill: self.bosskill,
        gpus: self.gpus,
        ledx: self.ledx
      }).then(function (response) {
        self.kills = 0
        self.pickedTeam = null
        self.bosskill = false
        self.gpus = 0
        self.ledx = 0
        Swal.fire({
          title: 'Gelukt!',
          text: 'De score is opgeslagen',
          type: 'success'
        })
      })
    }
  },
  beforeMount () {
    this.getTeams()
  }
}
</script>
