create schema IF NOT EXISTS notes;

create table IF NOT EXISTS notes.note
(
    id         int,
    name       text null,
    secret_key text not null,
    category   int  not null,
    content    text not null,
    date       text not null
);

alter table notes.note
    add constraint note_pk
        primary key (id);

alter table notes.note
    modify id int auto_increment;

