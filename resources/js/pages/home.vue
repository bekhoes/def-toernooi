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
        <label>Dogtags Teamleider</label>
        <input type="number" v-model="dogtags_teamleader" class="form-input w-full">
        <label>Intel</label>
        <input type="number" v-model="intel" class="form-input w-full">
        <label>Roler</label>
        <input type="number" v-model="roler" class="form-input w-full">
        <label>Fuel</label>
        <input type="number" v-model="fuel" class="form-input w-full">
        <label>Golden TT</label>
        <input type="number" v-model="tt" class="form-input w-full">
        <label>
          <input type="checkbox" v-model="reshala" class="form-checkbox">
          Reshala kill
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
    dogtags_teamleader: 0,
    reshala: false,
    intel: 0,
    roler: 0,
    fuel: 0,
    tt: 0,
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
        dogtags_teamleader: self.dogtags_teamleader,
        intel: self.intel,
        roler: self.roler,
        reshala: self.reshala,
        fuel: self.fuel,
        tt: self.tt,
      }).then(function (response) {
        self.kills = 0
        self.pickedTeam = null
        self.reshala = false
        self.tt = 0
        self.fuel = 0
        self.roler = 0
        self.intel = 0
        self.dogtags = 0
        self.dogtags_teamleader = 0
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
