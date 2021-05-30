<template>
  <div class="w-full h-full flex">
    <div class="w-1/2 mx-auto">
      <form class="bg-gray-300 p-4 rounded-xl" @submit.prevent="save">
        <label>Team</label>
        <select v-model="pickedTeam" class="w-full form-select">
          <option v-for="team in teams" :key="team.id" :value="team.id" class="p-2">{{ team.id }} | {{ team.name }}</option>
        </select>
        <label>PMC Kill</label>
        <input type="number" v-model="kills" class="form-input w-full">
        <label>Dogtags</label>
        <input type="number" v-model="dogtags" class="form-input w-full">
        <label>Labs Keycard (normaal & colored)</label>
        <input type="number" v-model="labskey" class="form-input w-full">
        <label>Graphics Cards</label>
        <input type="number" v-model="gpus" class="form-input w-full">
        <label>Tetris</label>
        <input type="number" v-model="tetris" class="form-input w-full">
        <label>Ledx's</label>
        <input type="number" v-model="ledx" class="form-input w-full">
        <label>Moonshine</label>
        <input type="number" v-model="moonshine" class="form-input w-full">
        <label>Waterfilter</label>
        <input type="number" v-model="waterfilter" class="form-input w-full"><br>
        <label>
          <input type="checkbox" v-model="helmet" class="form-checkbox">
          Killa Helm
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
    dogtags: 0,
    helmet: false,
    gpus: 0,
    tetris: 0,
    ledx: 0,
    labskey: 0,
    moonshine: 0,
    waterfilter: 0,
    started: false,
    teamName: '',
    teamMate1BSG: '',
    teamMate1DSC: '',
    teamMate1Class: '',
    teamMate2BSG: '',
    teamMate2DSC: '',
    teamMate2Class: '',
    teamMate3BSG: '',
    teamMate3DSC: '',
    teamMate3Class: '',
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
        dogtags: self.dogtags,
        gpus: self.gpus,
        ledx: self.ledx,
        helmet: self.helmet,
        tetris: self.tetris,
        labskey: self.labskey,
        moonshine: self.moonshine,
        waterfilter: self.waterfilter
      }).then(function (response) {
        self.kills = 0
        self.pickedTeam = null
        self.helmet = false
        self.gpus = 0
        self.ledx = 0
        self.tetris = 0
        self.labskey = 0
        self.moonshine = 0
        self.dogtags = 0
        self.waterfilter = 0
        Swal.fire({
          title: 'Gelukt!',
          text: 'De score is opgeslagen',
          type: 'success'
        })
      })
    },
  },
  beforeMount () {
    this.getTeams()
  }
}
</script>
