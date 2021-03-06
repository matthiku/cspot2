<template>
  <v-toolbar color="blue">

    <!-- drop-down menu in Plan title bar -->
    <v-menu open-on-hover bottom right offset-y>

      <v-btn icon slot="activator" dark>
        <v-toolbar-side-icon></v-toolbar-side-icon>
      </v-btn>

      <v-card>
        <v-card-title class="subheading blue-grey--text text--lighten-1 pb-0 mb-0">Select Show Mode:</v-card-title>

        <v-list class="mt-0">
          
          <v-list-tile v-for="item in planMenuItems" :key="item.title" @click="planAction(item.action)">
            <v-icon class="mr-3">{{ item.icon }}</v-icon>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile>

          <div v-if="userIsAdmin">
            <hr>
            <v-list-tile>
              <template>
                <app-delete-plan-dialog :plan="plan"></app-delete-plan-dialog>
              </template>
            </v-list-tile>
          </div>
        </v-list>

      </v-card>

    </v-menu>


    <!-- toolbar title showing Plan title and type -->
    <v-toolbar-title class="white--text">

      {{ pageTitle }}:

      <v-chip large color="success" 
          class="mr-0" elevation-4
          :class="[ userIsAdmin ? 'cursor-pointer' : '' ]"
        >
        {{ planType }}</v-chip>

      <app-edit-plan-type-dialog
        v-if="userIsAdmin"
        :plan="plan"
        ></app-edit-plan-type-dialog>

    </v-toolbar-title>


    <v-spacer></v-spacer>

    <!-- show floating action button for a presentation menu -->
    <v-tooltip bottom>
      <v-speed-dial
        v-model="fab" bottom right open-on-hover
        slot="activator"
        direction="left"
        transition="slide-x-reverse-transition"
      >
        <v-btn
          v-model="fab" dark fab
          slot="activator"
          color="blue darken-2"
        >
          <v-icon>airplay</v-icon>
          <v-icon>close</v-icon>
        </v-btn>

        <v-tooltip v-for="(item, index) in planMenuItems"
            :key="index" bottom>
          <v-btn @click="planAction(item.action)"
              fab dark small 
              slot="activator"
              :color="item.color"
              >
            <v-icon>{{ item.icon }}</v-icon>
          </v-btn>
          <span>{{ item.title2 }}</span>
        </v-tooltip>
        
      </v-speed-dial>
      <span>Select Show Mode</span>
    </v-tooltip>

  </v-toolbar>
</template>


<script>
export default {
  props: ['plan', 'types', 'pageTitle', 'userIsAdmin'],

  computed: {
    presentation() {
      return this.$store.getters.presentation
    },
    planType () {
      if (this.plan && this.plan.id) {
        if (this.types instanceof Object) {
          return this.types[this.plan.type_id].name 
        } else {
          return this.plan.type_id
        } 
      }
      return 'Loading Plan...'
    }    
  },

  data () {
    return {
      planMenuItems: [],
      fab: false      
    }
  },

  mounted () {
    this.planMenuItems = [
      { icon: this.presentation.icons.lyrics,
        action: 'present',
        title: 'Present',
        title2: 'Full Presentation',
        color: 'green' },
      { icon: this.presentation.icons.lead,
        action: 'lead',
        title: 'Lead',
        title2: 'Leader\'s Script',
        color: 'indigo' },
      { icon: this.presentation.icons.chords,
        action: 'chords',
        title: 'Chords',
        title2: 'Chords',
        color: 'lime' },
      { icon: this.presentation.icons.music,
        action: 'music',
        title: 'Music',
        title2: 'Sheetmusic',
        color: 'red' }
    ]
  },

  methods: {
    planAction (what) {
      this.$router.push({ name: 'present', params: {seqNo: 1, presentationType: what} })
    }
  }
}
</script>
