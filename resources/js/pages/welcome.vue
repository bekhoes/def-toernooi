<template>
  <div class="w-full flex text-center">
    <div class="absolute top-0 right-0 p-6">
      <template v-if="authenticated">
        <router-link :to="{ name: 'dashboard.home' }" class="mx-4 transition-all duration-100 ease-in-out hover:text-teal-500">
          {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }" class="mx-4 transition-all duration-100 ease-in-out hover:text-teal-500">
          {{ $t('login') }}
        </router-link>
      </template>
    </div>

    <div class="mx-auto w-1/2 text-left" v-if="started == 'false'">
      <div class="text-center mt-8 pt-20">
        <h1 class="lg:text-6xl sm:text-4xl font-bold def-header-class"><span class="text-red-500">DUTCH</span> <span class="text-white">ELITE</span> <span class="text-blue-600">FORCES</span></h1>
        <h1 class="lg:text-8xl sm:text-6xl font-bold text-black" >TOERNOOI</h1>
      </div>
      <form class="form-bg p-4 rounded-xl" style="background-color: rgba(0, 0, 0, 0.50) !important;" @submit.prevent="registerTeam">
          <h1 class="text-center text-2xl font-bold text-white">REGISTRATIEFORMULIER</h1>
          <label class="text-white">
            Teamnaam
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="Teamnaam (Max. 20 karakters)" v-model="teamName">
          <br><br><br>
          <label class="text-white">
            Discord Speler 1
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="Discord" v-model="teamMate1DSC">
          <label class="text-white">
            EFT Naam Speler 1
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="EFT" v-model="teamMate1BSG">
          <label class="text-white">
            Wapenklasse Speler 1
          </label>
          <select class="form-select w-full text-white" v-model="teamMate1Class" style="background-color: transparent !important; border-color: white;">
            <option style="color: black;" value="AR" :disabled="teamMate3Class == 'AR' || teamMate2Class == 'AR'">AR</option>
            <option style="color: black;" value="DMR" :disabled="teamMate3Class == 'DMR' || teamMate2Class == 'DMR'">DMR</option>
            <option style="color: black;" value="SMG" :disabled="teamMate3Class == 'SMG' || teamMate2Class == 'SMG'">SMG</option>
          </select>
          <br><br><br>
          <label class="text-white">
            Discord Speler 2
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="Discord" v-model="teamMate2DSC">
          <label class="text-white">
            EFT Naam Speler 2
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="EFT" v-model="teamMate2BSG">
          <label class="text-white">
            Wapenklasse Speler 2
          </label>
          <select class="form-select w-full text-white" v-model="teamMate2Class" style="background-color: transparent !important; border-color: white;">
            <option style="color: black;" value="AR" :disabled="teamMate3Class == 'AR' || teamMate1Class == 'AR'">AR</option>
            <option style="color: black;" value="DMR" :disabled="teamMate3Class == 'DMR' || teamMate1Class == 'DMR'">DMR</option>
            <option style="color: black;" value="SMG" :disabled="teamMate3Class == 'SMG' || teamMate1Class == 'SMG'">SMG</option>
          </select>
          <br><br><br>
           <label class="text-white">
            Discord Speler 3
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="Discord" v-model="teamMate3DSC">
          <label class="text-white">
            EFT Naam Speler 3
          </label>
          <input type="text" class="form-input w-full opacity-100 text-white" style="background-color: transparent !important; border-color: white;" placeholder="EFT" v-model="teamMate3BSG">
          <label class="text-white">
            Wapenklasse Speler 3
          </label>
          <select class="form-select w-full text-white" v-model="teamMate3Class" style="background-color: transparent !important; border-color: white;">
            <option style="color: black;" value="AR" :disabled="teamMate2Class == 'AR' || teamMate1Class == 'AR'">AR</option>
            <option style="color: black;" value="DMR" :disabled="teamMate2Class == 'DMR' || teamMate1Class == 'DMR'">DMR</option>
            <option style="color: black;" value="SMG" :disabled="teamMate2Class == 'SMG' || teamMate1Class == 'SMG'">SMG</option>
          </select>
          <br><br>
          <button class="def-button text-white" @submit.prevent="registerTeam" style="border: 2px solid; border-radius: 15px; padding: 8px 32px; font-weight: 900;">Registreer</button>
      </form>
    </div>
    <div class="mx-auto w-1/2" v-if="started == 'true'">
      <div class="text-center mt-8 pt-20">
        <h1 class="lg:text-6xl sm:text-4xl font-bold def-header-class"><span class="text-red-500">DUTCH</span> <span class="text-white">ELITE</span> <span class="text-blue-600">FORCES</span></h1>
        <h1 class="lg:text-8xl sm:text-6xl font-bold text-black" >TOERNOOI</h1>
        <h1 class="text-4xl font-bold text-white">LIVE SCOREBORD</h1>
      </div>
      <div class="text-6xl mb-4">
      </div>
      <table class="table table-auto w-full text-left rounded-xl def-table text-white" style="background-color: rgba(0, 0, 0, 0.5)">
        <thead>
          <tr>
            <th class="p-2">#</th>
            <th class="p-2">Teamnaam</th>
            <th class="p-2">Spelers</th>
            <th class="p-2">Punten</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="team, index in teams" :key="team.id">
            <td class="p-2">{{ index + 1 }}</td>
            <td class="p-2">{{ team.name }}</td>
            <td class="p-2">
              <span v-for="player in team.players" :key="player.id">
                {{player.tarkov_name}}<br>
              </span>
            </td>
            <td>{{ team.points }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="mx-auto w-1/2" v-if="started == 'hold'">
      <div class="text-center mt-8 pt-20">
        <h1 class="lg:text-6xl sm:text-4xl font-bold def-header-class"><span class="text-red-500">DUTCH</span> <span class="text-white">ELITE</span> <span class="text-blue-600">FORCES</span></h1>
        <h1 class="lg:text-8xl sm:text-6xl font-bold text-black" >TOERNOOI</h1>
        <h1 class="text-4xl font-bold text-white">AANMELDINGEN GESLOTEN!</h1>
      </div>
      <div class="text-center mb-20 mt-auto">
        <a href="https://discord.io/dutcheliteforces" class="text-blue-500 text-4xl hover:cursor-pointer font-bold" target="_blank">Join onze discord!</a>
      </div>
    </div> 
  </div>
</template>

<script>
import Axios from 'axios'
import { mapGetters } from 'vuex'
import index from './settings/index.vue'
import Swal from 'sweetalert2'

export default {
  components: { index },
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName,
    teams: {},
    started: true,
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

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
  methods: {
    registerTeam () {
      const self = this
      if (self.teamName.length > 20) {
        Swal.fire({
          type: 'error',
          title: 'Je teamnaam mag niet langer dan 20 karakters zijn.'
        })
      } else if (self.teamName == '' || self.teamMate1BSG == '' || self.teamMate1DSC == '' || self.teamMate1Class == '' || self.teamMate2BSG == '' || self.teamMate2DSC == '' || self.teamMate2Class == '' || self.teamMate3BSG == '' || self.teamMate3DSC == '' || self.teamMate3Class == '') {
        Swal.fire({
          type: 'error',
          title: 'Je hebt niet alle velden ingevuld.'
        })
      } else {
        Axios.post('/api/register-team', {
          team_name: self.teamName,
          teamMate1BSG: this.teamMate1BSG,
          teamMate1DSC: this.teamMate1DSC,
          teamMate1Class: this.teamMate1Class,
          teamMate2BSG: this.teamMate2BSG,
          teamMate2DSC: this.teamMate2DSC,
          teamMate2Class: this.teamMate2Class,
          teamMate3BSG: this.teamMate3BSG,
          teamMate3DSC: this.teamMate3DSC,
          teamMate3Class: this.teamMate3Class,
        }).then(function (response) {
          Swal.fire({
            type: 'success',
            title: 'Je hebt team ' + self.teamName + ' opgegeven voor het DEF toernooi!'
          }) 
          this.teamName = ''
          this.teamMate1BSG = ''
          this.teamMate1DSC = ''
          this.teamMate1Class = ''
          this.teamMate2BSG = ''
          this.teamMate2DSC = ''
          this.teamMate2Class = ''
          this.teamMate3BSG = ''
          this.teamMate3DSC = ''
          this.teamMate3Class = ''
        })
      }
    },
    getTournamentStatus () {
      const self = this
      Axios.get('/api/settings').then(function (response) {
        console.log(response.data.value)
        self.started = response.data.value
        console.log(self.started)
      })
    },
    getTeams () {
      const self = this
      Axios.get('/api/teams').then(function (response) {
        self.teams = response.data
      }).finally( function () {
        for (let i = 0; i < self.teams.length; i++) {
          let points = 0;
          for (let j = 0; j < self.teams[i].raids.length; j++) {
            points =  (parseInt(points) + parseInt(self.teams[i].raids[j].points))
          }
          self.teams[i].points = parseInt(points)
        }
        self.teams.sort( function (a, b) {
          return a.points - b.points
        })
        self.teams.reverse()
        self.$forceUpdate()
      })
    },
    filterPoints () {
      const self = this
      let highest = 0;
    }
  },
  beforeMount () {
    this.getTeams()
    this.getTournamentStatus()
  },
  mounted: function () {
    window.setInterval(() => {
      this.getTeams()
    }, 10000)
  }
}
</script>
<style>
body > div#app {
  background-color: #0A0809 !important;
}
.form-bg {
  
}
.text-red-500 {
  color: #b5223d !important;
}
.text-blue-600 {
  color: #2648d0 !important;
}
.def-button {
  border: 2px solid;
  border-radius: 15px;
  padding: 8px 32px;
  font-weight: 900;
  transition-duration: 0.5s;
}
.def-button:hover {
  border: 2px solid;
  border-radius: 15px;
  padding: 8px 32px;
  border-color: transparent;
  background-color: white;
  color: black;
  font-weight: 900 ;
}
input {
  background-color: transparent !important;
  border-color: white;
}
select {
  background: transparent !important;
}
option {
  background-color: transparent !important;
}
.def-table {
  background-color: rgba(0, 0, 0, 0.50);
  color: white;
}
.def-table > tr {
  border: 0px
}
@media screen and (min-width: 1310px) {
  .def-header-class > span {
    line-height: 0;
  }
}
@media screen and (max-width: 1310px) {
    .def-header-class > span {
    line-height: 0.5;
  }
}

html {
  line-height: 1 im !important;
}