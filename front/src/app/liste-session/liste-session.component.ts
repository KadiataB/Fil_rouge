import { Component } from '@angular/core';
import { CalendarEvent, CalendarView } from 'angular-calendar';
import { isSameDay, isSameMonth } from 'date-fns';
import { CoursService } from '../services/cours.service';
import { registerLocaleData } from '@angular/common';
import localeFr from '@angular/common/locales/fr';
import { Subject } from 'rxjs';
registerLocaleData(localeFr);

@Component({
  selector: 'app-liste-session',
  templateUrl: './liste-session.component.html',
  styleUrls: ['./liste-session.component.css'],
})
export class ListeSessionComponent {
  viewDate: Date = new Date();

  view: CalendarView = CalendarView.Week;

  calendarView = CalendarView;

  events: CalendarEvent[] = [];

  sessions: any[] = [];

  activeDayIsOpen = false;

  refresh = new Subject<void>();

  constructor(private service: CoursService) {
    // const event1 = {
    //   title:"kadia",
    //   start:new Date("2023-10-11T10:00"),
    //   end:new Date("2023-10-11T16:00"),
    //   draggable:true,
    //   resizable:{
    //     beforeStart:true,
    //     afterEnd:true
    //   }
    // }
    //   this.events.push(event1)
    this.getSessions();
  }

  dayClicked({ date, events }: { date: Date; events: CalendarEvent[] }): void {
    if (isSameMonth(date, this.viewDate)) {
      if (
        (isSameDay(this.viewDate, date) && this.activeDayIsOpen === true) ||
        events.length === 0
      ) {
        this.activeDayIsOpen = false;
      } else {
        this.activeDayIsOpen = true;
      }
      this.viewDate = date;
    }
  }

  setValue(view: CalendarView) {
    this.view = view;
  }
  getSessions() {
    this.service.allSessions().subscribe((data) => {
      console.log(data);
      this.sessions = data.data;

      this.sessions.forEach((s) => {
        let event1 = {
          title: `Classe:${s.cours_classe.classe.libelle} </br> Professeur:${s.cours_classe.cours.professeur.nom}${s.cours_classe.cours.professeur.prenom} </br> Module:${s.cours_classe.cours.module} </br> Durée:${s.duree.heures}h${s.duree.minutes}`,
          start: new Date(`${s.date}T${s.hd}`),
          end: new Date(`${s.date}T${s.hf}`),
          draggable: true,
          resizable: {
            beforeStart: true,
            afterEnd: true,
          },
        };
        this.events.push(event1);
      });
    });
  }

  eventClicked(event: any) {
    console.log(event);
  }

  eventTimesChanged(event: any) {
    // console.log(event);
    event.event.start = event.newStart;
    event.event.end = event.newEnd;
    this.refresh.next();
  }
}
