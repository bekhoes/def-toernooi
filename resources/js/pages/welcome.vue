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

    <div class="mx-auto w-1/2">
      <div class="text-6xl mb-4">
      </div>
      <table class="table table-auto w-full text-left bg-gray-200 rounded-xl">
        <thead>
          <tr>
            <th class="p-2">#</th>
            <th class="p-2">Teamnaam</th>
            <th class="p-2">Spelers</th>
            <th class="p-2">Punten</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="team, index in teams" :key="team.id" class="border-4">
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
  </div>
</template>

<script>
import Axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName,
    teams: {}
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
  methods: {
    getTeams () {
      const self = this
      Axios.get('/api/teams').then(function (response) {
        self.teams = response.data
      }).finally( function () {
        for (let i = 0; i < self.teams.length; i++) {
          let points = 0;
          for (let j = 0; j < self.teams[i].raids.length; j++) {
            console.log(self.teams[i].raids[j].points)
            points = (points + self.teams[i].raids[j].points)
            console.log('total: ' + points)
          }
          self.teams[i].points = points
          console.log(self.teams)
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
  },
  mounted: function () {
    window.setInterval(() => {
      this.getTeams()
    }, 10000)
  }
}
</script>
