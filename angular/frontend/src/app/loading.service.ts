import { Injectable } from '@angular/core';
import {Subject} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class LoadingService {
  loadingSubject: Subject<boolean>;
  constructor() {
    this.loadingSubject = new Subject<boolean>();
  }

  show(): void {
    this.loadingSubject.next(true);
  }

  hide(): void {
    this.loadingSubject.next(false);
  }

  getSubject(): Subject<boolean> {
    return this.loadingSubject;
  }
}
