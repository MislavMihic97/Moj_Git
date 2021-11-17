--LABOS1:

/*zad1:Ispisati imena i prezimena zaposlenika, sortirati ih padaju�i po prezimenu */

select first_name, last_name 
from hr.employees
order by last_name desc;

/*zad2:Ispisati nazive odjela i ime i prezime voditelja za svakog od njih. Koliko ima odjela?*/

select department_name, first_name, last_name 
from departments d inner join employees e
on d.manager_id=e.employee_id;

/*zad3:Kreirati upit koji �e ispisati imena i prezimena zaposlenika zajedno s nazivima odjela u kojima rade.*/

select first_name, last_name, department_name, employee_id
from employees e inner join departments d
on e.department_id=d.department_id;

/*zad4:Kreirati upit koji �e dohvatiti sve odjele i broj zaposlenika u svakom od njih (mora dohvatiti i odjele 
koji nemaju niti jednog zaposlenika). Sortirati prema broju zaposlenika u odjelu tako da se prvo ispi�u odjeli s ve�im brojem zaposlenika.*/

select e.department_id, department_name, count(employee_id)
from employees e right join departments d 
on e.department_id=d.department_id
group by e.department_id, department_name
order by 3 desc;


/*zad5,6:Kreirati dodatnog usera i dodijeliti mu role: CONNECT, RESOURCE, DBA, SELECT_CATALOG_ROLE, EXECUTE_CATALOG_ROLE. 
Spojiti se kao novi korisnik i kreirati sekvencu koraka 5.Kori�tenjem SQL-a kreirati tablicu zaposlenika u shemi novog korisnika.
Provjeriti koja ograni�enja postoje na novoj tablici. ID zaposlenika �elimo automatski generirati iz sekvence kreirane 
u prethodnom zadatku (pogledati dodatak B).*/

create sequence seq_1
increment by 5;

--create table employees2


--LABOS2:

/*zad1:Dohvatiti zaposlenike uz njihove nadre�ene (imena i prezimena managera i zaposlenika; 
manager je direktno nadre�eni iz tablice employees).*/

select m.first_name, m.last_name, e.first_name, e.last_name
from employees e left join employees m 
on e.manager_id=m.employee_id;

/*zad2:Dohvatiti sve zaposlenike kojima je manager John Russell (direktno nadre�eni iz tablice employees).*/

select e.* 
from employees e inner join employees m on e.manager_id=m.employee_id
where m.first_name='John' and m.last_name='Russell';

/*zad3:Kori�tenjem SQL-a kreirati tablicu russel_emps pomo�u upita iz prethodnog zadatka.*/

create table russel_emps as
select e.* 
from employees e inner join employees m on e.manager_id=m.employee_id
where m.first_name='John' and m.last_name='Russell';

/*zad4:Kreirati sekvencu seq_russel koja kre�e od 1000 i koraka je 7.*/

create sequence seq_russel
start with 1000
increment by 7;

/*zad5:Dohvatite slijede�u vrijednost sekvence seq_russel nekoliko puta (koristiti dummy tablicu DUAL).*/

select seq_russel.nextval 
as seq from dual;

/*zad6:U tablicu russel_emps insert naredbom ubacite podatke o sebi. 
Employee_ID ubacite iz sekvence seq_russel, job_ID SA_REP, department_ID 80, a ostale podatke izmislite. 
Potvrdite promjene (COMMIT).*/


insert into russel_emps --(employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id)
values (seq_russel.nextval, 'Mislav', 'Mihi�', 'MIMIHIC', null, to_date('31/10/2019', 'DD/MM/YYYY'), 'SA_REP', '15000', null, '145', '80');
commit;

/*zad7:a�urirajte tablicu russel_emps (naredba UPDATE): department_ID postavite u 280 za sve zapise za koje je employee_ID > 1000. 
Potvrdite promjene (COMMIT).*/

update russel_emps 
set department_id=280
where employee_id>1000;
commit;

/*zad8:Ispi�ite za svakog zaposlenika iz russel_emps tablice njegovo ime, prezime i naziv odjela iz tablice departments 
(Koristite inner join). Kakav je status za novounesene zapise?*/

select r.first_name, r.last_name, department_name 
from russel_emps r inner join departments d
on r.department_id=d.department_id;

/*zad9:Kopirajte i prepravite upit iz prethodnog zadatka u lijevi / desni / potpuni spoj. 
�to dohva�amo u svakom od navedenih slu�ajeva?*/

select r.first_name, r.last_name, department_name 
from russel_emps r left join departments d
on r.department_id=d.department_id;

select r.first_name, r.last_name, department_name 
from russel_emps r right join departments d
on r.department_id=d.department_id;

select r.first_name, r.last_name, department_name 
from russel_emps r full join departments d
on r.department_id=d.department_id;

/*zad10:Kopirajte upit iz 1. zadatka i prepravite ga na na�in da prebrojite podre�ene zaposlenike po manageru?*/

select count(m.employee_id)
from employees e left join employees m 
on e.manager_id=m.employee_id;

/*zad11:Kopirajte upit iz prethodnog zadatka i prepravite ga na na�in da dohvatite i sumu pla�a zaposlenika grupirano 
po nadre�enom manageru.*/

select count(m.employee_id), avg(e.salary)
from employees e left join employees m 
on e.manager_id=m.employee_id
group by e.manager_id;

/*zad12:Kopirajte upit iz prethodnog zadatka i prepravite ga na na�in da iz rezultata 
izbacite one n-torke za koje je suma pla�a zaposlenika nekog managera manja od 40000.*/

select sum(m.salary) as sum
from employees e inner join employees m 
on e.manager_id=m.employee_id
where sum(m.salary)>40000
group by e.manager_id;--??

/*zad13:Kopirajte i prepravite upit iz prethodnog zadatka tako da rezultat bude sortiran silazno po prosje�noj pla�i.*/

select avg(e.salary)
from employees e inner join employees m 
on e.manager_id=m.employee_id
group by e.manager_id
order by avg(e.salary) desc;

--LABOS3:

/*zad1:Dohvatiti ime i prezime zaposlenika, naziv njegovog radnog mjesta, naziv odjela u kojem radi, te njegovu pla�u. 
Neka u ispisu budu svi zaposlenici, �ak i oni koji nisu raspore�eni niti u jedan odjel. */

select first_name, last_name, job_title, department_name, salary
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id;

/*zad2:Koriste�i rezultat iz prethodnog zadatka prebrojati zaposlenike i 
prona�i prosjek pla�a po nazivu odjela i po nazivu pozicije.*/

select job_title, department_name, avg(salary), count(employee_id)
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id
group by job_title, department_name;

/*zad3:Kori�tenjem rezultata prethodnog zadatka dodati me�usume kori�tenjem klju�ne rije�i CUBE.*/

select job_title, department_name, avg(salary), count(employee_id)
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id
group by cube(job_title, department_name);

/*zad4:U rezultat prethodnog zadatka dodati GROUPING klauzule za naziv odjela i za naziv pozicije.*/

select grouping(job_title), grouping(department_name), avg(salary), count(employee_id)
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id
group by cube(job_title, department_name);

/*zad5:Provjeriti i objasniti zapise u kojima se pojavljuju NULL vrijednosti u oba polja department_name i job_title.*/

--OBJA�NJENO!!

/*zad6:U rezultat 4. zadatka dodati u �where� sekciju uvjet da je department_name NULL. �to dobijamo u rezultatu?*/

select grouping(job_title), grouping(department_name), avg(salary), count(employee_id)
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id
where department_name is null 
group by cube(job_title, department_name);


/*zad7:U rezultat 4. zadatka dodati u �having� sekciju uvjet da je department_name NULL. 
�to dobijamo u rezultatu? Nazna�iti koja je klju�na razlika u odnosu na prethodni zadatak.*/

select grouping(job_title), grouping(department_name), avg(salary), count(employee_id)
from employees e left join departments d 
on e.department_id=d.department_id inner join jobs j on e.job_id=j.job_id
group by cube(job_title, department_name)
having department_name is null ;

/*zad8:Koriste�i analiti�ke funkcije ispi�ite uz svakog zaposlenika njegov odjel i prosje�nu pla�u u tom odjelu.*/

select employee_id, first_name, last_name, department_name, avg(salary) over (partition by department_name) avg
from employees e inner join departments d
on e.department_id=d.department_id;

/*zad9:Koriste�i analiti�ke funkcije rangirati pla�u svakog zaposlenika unutar njegovog odjela kori�tenjem RANK() funkcije.*/

select employee_id, first_name, last_name, department_name, rank() over (partition by department_name order by salary desc) rnk
from employees e inner join departments d
on e.department_id=d.department_id;

/*zad10:Promotrite rezultat odjela �IT�. Promijenite RANK() u DENSE_RANK() i zapi�ite po �emu se rezultati razlikuju.*/

select employee_id, first_name, last_name, department_name, dense_rank() over (partition by department_name order by salary desc) dr
from employees e inner join departments d
on e.department_id=d.department_id;

/*zad11:Promotrite rezultat odjela �IT�. Promijenite DENSE_RANK() u ROW_NUMBER() i zapi�ite po �emu se rezultati razlikuju.*/

select employee_id, first_name, last_name, department_name, row_number() over (partition by department_name order by salary desc) rn
from employees e inner join departments d
on e.department_id=d.department_id;


--LABOS4:

/*zad1:Dohvatite zaposlenike koji su ikada ranije radili na poziciji (job_id) 'ST_CLERK' kori�tenjem IN operatora.*/

select *
from employees  
where employee_id in (select employee_id from job_history where job_id='ST_CLERK');

/*zad2:Pro�irite upit iz 1. zadatka na na�in da dohvatite i one zaposlenike koji trenutno rade na poziciji 'ST_CLERK'.*/

select *
from employees  
where employee_id in (select employee_id from job_history where job_id='ST_CLERK') 
and employee_id in (select employee_id from jobs where job_id='ST_CLERK'); --?

/*zad3:Kreirajte tablicu s rangom zaposlenika SALARY_RANGE sa sljede�im stupcima: 
sal_from number(8,2), sal_to number(8,2), sal_range varchar2(5), sal_desc varchar2(100)
U tablicu pomo�u insert naredbi ubacite podatke kako je prikazano:*/

create table SALARY_RANGE (
        sal_from number(8,2),
        sal_to number(8,2),
        sal_range varchar2(5),
        sal_desc varchar2(100)
        );
        
insert into SALARY_RANGE (
        sal_from,
        sal_to,
        sal_range,
        sal_desc
        )
values
    (
        0.00,
        5000.00,
        'L5',
        'placa do 5.000'
    );

insert into SALARY_RANGE (
        sal_from,
        sal_to,
        sal_range,
        sal_desc
        )
values 
    (
        5000.01,
        10000.00,
        'L4',
        'placa 5.000-10.000'
    );
insert into SALARY_RANGE (
        sal_from,
        sal_to,
        sal_range,
        sal_desc
        )
values
    (
        10000.01,
        15000.00,
        'L3',
        'placa 10.000-15.000'
    );
insert into SALARY_RANGE (
        sal_from,
        sal_to,
        sal_range,
        sal_desc
        )
values 
    (
        15000.01,
        20000.00,
        'L2',
        'placa 15.000-20.000'
    );
insert into SALARY_RANGE (
        sal_from,
        sal_to,
        sal_range,
        sal_desc
        )
values
    (
        20000.01,
        100000.00,
        'L1',
        'placa preko 20.000'
    );
    
/*Koriste�i non-equijoin dohvatite ime i prezime zaposlenika i njegov platni razred (sal_range)*/

select e.first_name, e.last_name, sr.sal_range
from employees e, salary_range sr
where e.salary between sr.sal_from and sr.sal_to;

/*zad4:Kori�tenjem podupita u WHERE sekciji dohvatite sve zaposlenike koji rade u gradu Seattle (LOCATIONS.CITY).*/

select *
from employees
where department_id in (select department_id from departments d inner join locations l on d.location_id=l.location_id where city='Seattle'); 

/*zad5:Kori�tenjem podupita u FROM sekciji dohvatite sve zaposlenike koji rade u gradu Seattle.*/

select distinct e. *
from employees e , (select department_id from departments d inner join locations l on d.location_id=l.location_id where city='Seattle');

/*zad6:Kori�tenjem koreliranog podupita s operatorom ALL dohvatite sve zaposlenike koji imaju maksimalnu pla�u u svom odjelu.*/

select e. *
from employees e 
where employee_id <= ALL (select max(salary) from employees e inner join jobs j on e.job_id=j.job_id); --??

/*zad7: x */

/*zad8:Kori�tenjem podupita i operatora EXISTS dohvatite sve zaposlenike za koje bilo tko u njihovom odjelu ima ve�u pla�u od njih.*/

select *
from employees
where exists (select job_id from jobs where max_salary); --??


/*zad9:Kori�tenjem razlike dohvatite sve employee_ID zaposlenika koji nisu nikada mijenjali posao.*/

select employee_id from employees
minus
select employee_id from job_history;

/*zad10:Kori�tenjem UNION ALL dohvatite sve zaposlenike iz RUSSEL_EMPS tablice i sve zaposlenike iz tablice 
EMPLOYEES kojima je direktno nadre�eni manager_ID 145 ili 100. Koliko zapisa dohva�ate?*/

select * from russel_emps
union all
select * from employees where manager_id=100 or manager_id=145
order by 1;

/*zad11:Prepravite upit iz prethodnog zadatka tako da umjesto UNION ALL koristite UNION. Koliko sada zapisa dohva�ate? 
Koji zapisi su nestali i za�to?*/

select * from russel_emps
union
select * from employees where manager_id=100 or manager_id=145
order by 1;

/*zad12:Dohvatite presjek zaposlenika iz RUSSEL_EMP tablice i svih zaposlenika koji rade u odjelima Sales, Executive ili Finace.*/

select * from russel_emps
intersect
select e. * from employees e inner join departments d on e.department_id=d.department_id
where department_name='Sales' or department_name='Executive' or department_name='Finace';


--LABOS5:

/*zad1:Dohvatite prosjek pla�e po odjelima zaokru�en na 2 decimale.*/

select department_id, round(avg(salary),2)
from employees 
group by department_id;

/*zad2:U prethodni upit dodajte i TRUNC prosje�ne pla�e na dvije decimale.*/

select department_id, round(avg(salary),2), trunc(avg(salary),2)
from employees 
group by department_id;

/*zad3:Dohvatite minimalni datum zaposlenja (hire_date) za svaki odjel.
Kori�tenjem funkcije TRUNC zanemarite dan.*/

select department_id, trunc(min(hire_date), 'MM')
from employees 
group by department_id;

/*zad4:Prepravite prethodni zadatak tako da umijesto TRUNC naredbe formatirate prikaz datum na na�in da se ispi�e mjesec/godina.*/

select department_id, to_char(min(hire_date), 'MM/YYYY') 
from employees 
group by department_id;

/*zad5:Dohvatite za svaki department_ID odjela iz DEPARTMENTS tablice DEPARTMENT_ID cjelobrojno podijeljen s 9 i 
ostatak pri cjelobrojnom dijeljenju s 9.*/

select department_id, department_id/9 as dijeljenje, mod(department_id,9)
from departments;

/*zad6:Ispi�ite iz tablice ureda (LOCATIONS) adresu na na�in da
prvo slovo svake rije�i bude veliko, a sva ostala mala.*/

select initcap(street_address)
from locations;

/*zad7:Ispi�ite iz tablice zaposlenika ime velikim a prezime malim slovima,
te spojeno ime i prezime odvojeno jednim 'blankom' (konkatenacija),
ali samo za one zaposlenike kojima je prezime du�e od 9 znakova.*/

select upper(first_name), lower(last_name), first_name||' '||last_name
from employees 
where length(last_name)>9;

/*zad8:Ispi�ite ime, prezime i inicijale samo onih zaposlenika
koji na 3. I 4. poziciji prezimena imaju 'al' ili u imenu imaju 'th'.*/

select first_name, last_name, substr(first_name,1,1), substr(last_name,1,1)
from employees
where substr(first_name,3,2)='th' or substr(last_name,3,2)='al';

/*zad9:Dohvatite uz svakog zaposlenika zadnja dva slova prezimena.*/

select last_name, substr(last_name, -2)
from employees;

/*zad10:Dohvatite trenutno sistemsko vrijeme na na�in da se vidi samo mjesec i godina odvojeni to�kom.*/

select to_char(sysdate, 'MM.YYYY')
from dual;

/*zad11:Dohvatite trenutno sistemsko vrijeme na na�in da se vidi dan, mjesec i godina odvojeni 
to�kama, razmak, sat, minuta i sekunde odvojeni dvoto�kama.*/

select to_char(sysdate, 'DD.MM.RRRR HH24:MI:SS')
from dual;

/*zad12:Formatirajte trenutno sistemsko vrijeme na na�in da se vidi mjesec pa dan pa godina odvojeni crticom.*/

select to_char(sysdate, 'MM-DD-RRRR')
from dual;

/*zad13:Dohvatite zadnji datum teku�eg mjeseca.*/

select sysdate, last_day(sysdate)
from dual;

/*zad14:Dohvatite zadnji datum prethodnog mjeseca.*/

select last_day(add_months(sysdate,-1))
from dual;

/*zad15:Dohvatite prvi u sljede�em mjesecu.*/

select last_day(sysdate)+1
from dual;

/*zad16:Dohvatite prvi po redu prvi u mjesecu nakon �to protekne 6 mjeseci.*/

select last_day(add_months(sysdate,6))+1
from dual;

/*zad17:Dohvatite prekosutra u isto vrijeme (trenutni datum + 2 dana).*/

select sysdate+2
from dual;

/*zad18:Dohvatite trenutni datum i vrijeme, te isti datum i vrijeme povecano za 2 sata.*/

select to_char(sysdate, 'DD.MM.RRRR HH24:MI:SS'), to_char(sysdate +2/24, 'DD.MM.RRRR HH24:MI:SS')
from dual;

/*zad19:Pla�e se primaju 5. u mjesecu. Dohvatite za svakog zaposlenika datum zaposlenja i datum kada su primili prvu pla�u.*/

select first_name, last_name, hire_date, last_day(hire_date)+5 as first_payday
from employees;


--LABOS6:

/*zad1:Iz tablice zaposlenika (employees) provjeriti koliko poslova (job_ID) je u aktivnoj upotrebi
(postoje zaposlenici s navedenim poslom); drugim rije�ima prebrojati koliko ima razlicitih job_ID.*/

select count(distinct job_id)
from employees;


/*zad2:Dohvatiti sve zaposlenike (employees.employee_ID, employees.first_name, employees.last_name) 
zajedno s podatkom o adresi u kojem je ured za njihov odjel (locations.street_address).*/

select e.employee_id, e.first_name, e.last_name, l.street_address
from employees e left join departments d on e.department_id=d.department_id inner join locations l on d.location_id=l.location_id;

/*zad3:Dohvatiti minimalnu i prosje�nu pla�u (salary) zaposlenika po odjelu u kojeg su raspore�eni (department_ID).*/

select department_id, min(salary), avg(salary)
from employees
group by department_id;

/*zad4:Dohvatiti ime i prezime zaposlenika (first_name, last_name), te datum zaposlenja formatiran na na�in da se vidi dan, mjesec i godina 
zaposlenja odvojeni znakom - (primjerice uz osobu koja je zaposlena 12.3.2001 godine, treba biti prikazano 12-03-2001).*/

select first_name, last_name, to_char(hire_date, 'DD-MM-YYYY')
from employees;

/*zad5:Dohvatiti sve zaposlenike (employee_id, first_name, last_name) koji su neko� radili ili sada rade u odjelu (department_ID) 80.
Prethodna radna mjesta zaposlenika zapisana su u JOB_HIST tablici, a trenutna u EMPLOYEES tablici.*/

select employee_id, first_name, last_name
from employees e 
where department_id = 80 or employee_id in (select employee_id from job_history where department_id = 80); 

--LABOS7:

/*zad1:Iz tablice DEPARTMENTS ispisati sljede�e podatke: naziv odjela, ukoliko postoji unesen voditelj odjela (DEPARTMENTS.MANAGER_ID),
ispisati 'Odjel ima voditelja', a ukoliko ne postoji 'Odjel je obezglavljen'.*/

select department_name,
    case 
        when manager_id is not null then 'Odjel ima voditelja.'
        else 'Odjel je obezglavljen.'
    end as voditelj_odjel
from departments;

/*zad2:Iz tablice DEPARTMENTS ispisati sljede�e naziv odjela i MANAGER_ID,
a ako MANAGER_ID nije unesen onda umijesto toga ispisati -1.*/

select department_name, manager_id,
    case
        when manager_id is null then '-1'
    end as voditelj
from departments;

/*zad3:Dohvatiti podatke o lokacijama ureda (location_ID, postal_code, city, state_province i country_ID). 
Ako STATE_PROVANCE nije uneseno, umijesto toga ispisati 'Nepoznato'.*/

select location_id, postal_code, city, state_province, country_id,
    case
        when state_province is null then 'Nepoznato!'
    end as SP
from locations;

/*zad4:Dohvatiti zaposlenike (spojeno ime i prezime s razmakom), odjel u kojeg su raspore�eni ukoliko je unesen i voditelje odjela 
(spojeno ime i prezime s razmakom za managera iz tablice DEPARTMENTS). U rezultatu moraju biti svi zaposlenici.*/

select first_name||' '||last_name, m.first_name||' '||m.last_name
    case 
        when department_id is null then 'Nepoznato'
        else to_char(department_id)
    end as odjel
from employees; --e inner join employees m on e.manager_id=m.employee_id; --???


/*zad5:Kopirati i prepraviti upit iz prethodnog zadatka: ukoliko zaposlenik nije raspore�en u odjel ili ukoliko je raspore�en u odjel za kojeg voditelj
nije unesen, umijesto imena i prezimena managera treba ispisati 'Nepoznato'.*/

select first_name||' '||last_name,
    case
        when department_id is null then 'Nepznato'
        when manager_id is null then 'Nepoznato'
        else 
    end as ime_prezime_managera
from employees; --???

/*zad6:Prepraviti upit iz prethodnog zadatka na na�in da za STATE_PROVINCE ispisuje 'Texas' ako je u pitanju Texas, 'Nepoznato' ako podatak nije unesen,
'Ostalo' ako je uneseno ne�to osim Texas. Koristiti DECODE naredbu.*/

select location_id, postal_code, city, state_province, country_id, decode(state_province, 'Texas' , 'Texas' , null , 'Nepoznato' , 'Ostalo') SP
from locations;

/*zad7:Prepraviti upit iz prethodnog zadatka tako da koristi CASE naredbu.*/

select location_id, postal_code, city, state_province, country_id,
    case
        when state_province='Texas' then 'Texas'
        when state_province is null then 'Nepoznato'
        else 'Ostalo'
    end as SP
from locations;

/*zad8:Dohvatiti sve lokacije koje u nazivu grada imaju 'ou' kori�tenjem operatora like.*/

select location_id, city 
from locations
where city like '%ou%';

/*zad9:Kori�tenjem operatora like dohvatiti sve lokacije koje u nazivu grada imaju 'ou' i zavr�avaju slovom 'k'.*/

select location_id, city
from locations
where city like '%ou%k';

/*zad10:Dohvatiti sve lokacije koje u nazivu grada imaju barem dva slova 'o', koristiti operator LIKE.*/

select location_id, city
from locations
where city like '%o%o%';


--LABOS8/9:

/*zad1:Dohvatite hijerarhijskim upitom iz tablice employees sve podre�ene za zaposlenika s employee_id = 101 (dohvatite employee_id, last_name i manager_id). Prezime neka bude ispisano uvu�eno (lpad blankova) u ovisnosti o levelu i putanju od zaposlenika 101 do dohva�enog zaposlenika.
a. Kopirajte i prepravite upit iz prethodnog zadatka tako da isklju�ite i zaposlenika 108 i sve njemu podre�ene zaposlenike.
b. Kopirajte i prepravite upit iz 1. zadatka tako da isklju�ite zaposlenika 108, a tako da njegovi podre�eni ostanu u rezultatu.*/

select lpad(' ', 2*level-1)||last_name, employee_id, manager_id, level,
SYS_CONNECT_BY_PATH (last_name, '/')
from employees
start with employee_id = 101
connect by prior employee_id = manager_id;

select lpad(' ', 2*level-1)||last_name, employee_id, manager_id, level,
SYS_CONNECT_BY_PATH (last_name, '/')
from employees
start with employee_id = 101
connect by prior employee_id = manager_id and employee_id<>108;

select lpad(' ', 2*level-1)||last_name, employee_id, manager_id, level,
SYS_CONNECT_BY_PATH (last_name, '/')
from employees
where employee_id<>108
start with employee_id = 101
connect by prior employee_id = manager_id;

/*zad2:Kreirajte pogled naziva phonebook koji prikazuje naziv odjela, ime i prezime zaposlenika, te email i broj telefona za sve zaposlenike koji rade 
u odjelima 70, 80 ili 90. Dohvatite iz pogleda sve zaposlenike s imenom Peter.*/

create view phonebook
    as
    select department_name, first_name, last_name, email, phone_number
    from employees e inner join departments d on e.department_id=d.department_id
    where e.department_id in (70, 80, 90);
    
select first_name, last_name
from phonebook
where first_name='Peter';

/*zad3:U neimenovanom PL/SQL bloku ispi�ite u output prozoru 'Hello world' kori�tenjem dbms_output.put_line.
Napomena: prije izvr�avanja PL/SQL bloka izvr�ite naredbu SET SERVEROUTPUT ON da omogu�ite prikaz outputa.
To �e promijeniti parametar na nivou sessiona, pa za sljede�a izvr�avanja PL/SQL blokova to nije potrebno ponavljati.*/

set serveroutput on

declare
begin
    dbms_output.put_line('Hello world');
end;

/*zad4:U neimenovanom PL/SQL bloku deklarirajte tekstualnu varijablu i postavite joj vrijednost na 'Hello world'. 
Ispi�ite vrijednost varijable u output prozoru.*/

declare 
    varijabla varchar2(30):='Hello world';
begin
    dbms_output.put_line(varijabla);
end;

/*zad5:U neimenovanom PL/SQL bloku deklarirajte tekstualnu varijablu koja prima korisni�ki unos iz serverske varijable. 
Izvr�ite blok, unesite svoje ime i ispi�ite vrijednost varijable u output prozoru.Napomena: za unos parametra, odnosno serverske varijable, 
koristimo &naziv_varijable (nije ju potrebno deklarirati unutar PL/SQL bloka). Prilikom pridru�ivanja tekstualne vrijednosti varijabli moramo je 
staviti u navodnike '&naziv_varijable' ili prilikom korisni�kog unosa upisati navodnike.*/

declare
    v_name varchar2(25):= '&v_name';
begin
    dbms_output.put_line(v_name);
end;

/*zad6:U neimenovanom PL/SQL bloku deklarirajte dvije numeri�ke varijable x i y; vrijednosti postavite iz serverske varijable (prompt).
a. Ispi�ite zbroj brojeva x i y.
b. Prepravite zadatak tako da ispi�ete u izlaznoj poruci vrijednosti x + y = (x+y). 
Primjerice ako unesete brojeve 2 i 9, u izlaznoj poruci treba pisati: 2 + 9 = 11
c. Prepravite zadatak tako da u izlaznoj poruci ispi�ete negativne brojeve u zagradama. Primjerice ako unesete brojeve -2 i -9, u izlaznoj poruci treba 
pisati: (-2) + (-9) = (-11)*/

declare
    x number := &x;
    y number := &y;
begin
    dbms_output.put_line(x+y);
end;

declare
    x number := &x;
    y number := &y;
begin
    dbms_output.put_line(x || '+' || y || '=' || (x+y));
end;

declare
    x number := &x;
    y number := &y;
begin
    dbms_output.put_line('(' ||x|| ')' || '+' || '(' ||y|| ')' || '=' || '(' || (x+y) || ')');
end;

/*zad7:U neimenovanom PL/SQL bloku deklarirajte dvije numeri�ke varijable x i y; vrijednosti postavite iz serverske varijable (prompt). 
Ukoliko je razlika x i y pozitivan broj ili 0, ispi�ite ga. Ukoliko je razlika negativan broj, ispi�ite poruku da je razlika brojeva x i y negativan broj.*/

declare
    x number := &x;
    y number := &y;
begin
    if (x-y)>=0 then
        dbms_output.put_line(x-y);
    else
        dbms_output.put_line('Razlika brojeva x i y je negativan broj!');
    end if;
end;


/*zad8:U neimenovanom PL/SQL bloku deklarirajte tekstualnu varijablu za prezime zaposlenika (postavite vrijednost koriste�i prompt, serversku varijablu),
te numeri�ku varijablu cnt. Vrijednosti cnt postavite iz upita � cnt je broj zaposlenika iz tablice employees s navedenim prezimenom. 
Ukoliko je broj zaposlenika 0, ispi�ite da ne postoji zaposlenik s navedenim prezimenom. Ukoliko je broj zaposlenika to�no 1, ispi�ite 'bingo'. 
Ukoliko je broj zaposlenika ve�i od 1, ispi�ite da postoji vi�e zaposlenika s navedenim prezimenom.*/

declare
    v_prezime varchar2(25) := '&v_prezime';
    cnt number;
begin
    select count(*) into cnt
        from employees
        where last_name = v_prezime;
    if cnt=0 then
        dbms_output.put_line('Ne postoji zaposlenik s navedenim prezimenom!');
    elsif cnt=1 then
        dbms_output.put_line('BINGO!');
    else
        dbms_output.put_line('Postoji vi�e zaposlenika s navedenim prezimenom!');
    end if;
end;

/*zad9:Upi�ite niz znakova i dohvatite i ispi�ite broj zaposlenika iz tablice employees koji u imenu sadr�e navedene znakove.*/

declare
    v_znakovi varchar2(25) := '&v_znakovi';
    cnt number;
begin
    select count(*) into cnt
        from employees
        where first_name like '%v_znakovi%';
    dbms_output.put_line(cnt);
end;

/*zad10:Neka korisnik unese cijeli broj. Ukoliko je negativan, ili je broj ve�i od 9 ispi�ite 'Potrebno je upisati broj od 0 do 9'. 
Ukoliko je broj izme�u 0 i 9, na�ite i ispi�ite broj zaposlenika iz tablice employees za koje je ostatak pri dijeljenju employee_id s 
10 jednak zadanom broju.*/

declare
    broj number := &broj;
    cnt number;
begin
    if broj<0 or broj>9 then
        dbms_output.put_line('Potrebno je upisati broj od 0 do 9!');
    else
        select count(*) into cnt
            from employees
            where mod(employee_id,10) = broj;
        dbms_output.put_line(cnt);
    end if;
end;

--LABOS10:

/*zad1:Napi�ite program koji dohva�a zaposlenike sa zadanim employee_id i ispisuje njihovo ime, prezime i broj telefona. 
Ukoliko zaposlenik ne postoji, potrebno je ispisati adekvatnu poruku.*/

declare
    v_employee_id employees.employee_id%type := &broj;
    v_first_name varchar2(25);
    v_last_name varchar2(25);
    v_phone_number varchar2(20);
begin
    select first_name, last_name, phone_number, employee_id into v_first_name, v_last_name, v_phone_number, v_employee_id
    from employees
    where employee_id=v_employee_id;
    dbms_output.put_line(v_first_name || ',' || v_last_name || ',' || v_phone_number);
   exception 
    when no_data_found then
        dbms_output.put_line('Zaposlenik ne postoji!');
end;

/*zad2:Napi�ite program koji za uneseni department_id dohva�a podatke o voditelju odjela (ime, prezime i broj telefona iz employees tablice za managera 
- departments.manager_id), te o adresi i gradu u kojem je ured za navedeni odjel iz tablice locations. Ukoliko odjel s navedenim department_id ne postoji,
potrebno je ispisati adekvatnu poruku.*/

declare
    v_department_id departments.department_id%type := &broj;
    v_first_name varchar2(25);
    v_last_name varchar2(25);
    v_phone_number varchar2(20);
    v_street_address varchar2(25);
    v_city varchar2(25);
begin
    select first_name, last_name, phone_number, department_id, street_address, city 
    into v_first_name, v_last_name, v_phone_number, v_department_id, v_street_address, v_city
    from departments d left join employees e on d.manager_id=e.manager_id inner join locations l on d.location_id=l.location_id
    where department_id=v_department_id;
    dbms_output.put_line(v_first_name || ' ' || v_last_name || ',' || v_phone_number || ',' || v_street_address|| ',' || v_city);
   exception 
    when no_data_found then
        dbms_output.put_line('Odjel ne postoji!');
end;

/*zad3:Napi�ite program koji za uneseni department_id dohva�a podatak o broju zaposlenika koji rade u tom odjelu. Koriste�i CASE, ispi�ite osim naziva 
odjela i poruku:
- ukoliko u odjelu nitko ne radi: 'Nitko tu ne radi!'
- ukoliko u odjelu radi 1-7 zaposlenika: 'Odjel do 7 zaposlenika!'
- ukoliko u odjelu radi 8-13 zaposlenika: 'Odjel do 13 zaposlenika!'
- ukoliko u odjelu radi preko 13 zaposlenika: 'Odjel preko 13 zaposlenika!!!'
Obradite iznimku ukoliko korisnik unese nepostoje�i department_id.*/

declare
    v_department_id departments.department_id%type := &broj;
    cnt number;
begin
    select count(*) into cnt
    from employees
    where department_id=v_department_id;
        case 
            when cnt=0 then
                dbms_output.put_line('Nitko tu ne radi!');
            when cnt between 1 and 7 then
                dbms_output.put_line('Odjel do 7 zaposlenika!');
            when cnt between 8 and 13 then
                dbms_output.put_line('Odjel do 13 zaposlenika!');
            when cnt>13 then
                dbms_output.put_line('Odjel preko 13 zaposlenika!!!');
        end case;
    exception
        when no_data_found then
            dbms_output.put_line('Department_id ne postoji!');
end;

/*zad4:Za uneseni pozitivni broj n izra�unajte vrijednost n! (faktorijel).
Ukoliko korisnik unese pozitivni decimalni broj, upotrebite funkciju trunc za izra�un faktorijela. 
Ukoliko korisnik unese negativni broj, javite adekvatnu poruku.*/

declare
    n number := &n;
    faktorijel number := 1;
begin
    if n<0 then
        dbms_output.put_line('Broj je negativan!');
    else
    for i in 1..n loop
            faktorijel := faktorijel*i;
            end loop;
            dbms_output.put_line(faktorijel);
    end if;
end;

/*zad5:Za uneseni pozitivni cijeli broj n izra�unajte vrijednost 1 + 2 + ... + n.*/

declare 
    n number := &n;
    rezultat number := 0;
begin
    if n<0 then
          dbms_output.put_line('Broj je negativan!');
    else
        for i in 1..n loop
            rezultat := rezultat+i;
        end loop;
            dbms_output.put_line(rezultat);
    end if;
end;

/*zad6:Za unesene pozitivne cijele brojeve n i m izra�unajte najve�i zajedni�ki djeljitelj (testirajte djeljivost u petlji).*/

declare
    n number := &n;
    m number := &m;
    naj_zaj_dje number;
begin
    if n<0 or m<0 then
        dbms_output.put_line('Broj je negativan!');
    else
        while mod(n, m) != 0 loop  
            naj_zaj_dje := mod(n, m);  
            n := m;  
            m := naj_zaj_dje;  
        end loop;  
  
    dbms_output.put_line('Najve�i zajedni�ki djeljitelj od ' || n  || ' i ' || m  ||' je ' || m);  
    end if; 
end;

/*zad7:Za svaki broj od 5 do 15 ispi�ite prvo �Fakori broja trenutni_broj� 
i nakon toga ispi�ite sve brojeve od 1 do tog broja s kojima je trenutni_broj djeljiv.*/

declare
    trenutni_broj number := &trenutni_broj;
begin
    for i in 5..15 loop
        for j in 15..5 loop
            if trenutni_broj = (i*j) then
                dbms_output.put_line('Faktori broja' || trenutni_broj || 'su' || i || 'i' || j || '.');
            else
                dbms_output.put_line('Broj nema faktore izme�u 5 i 15!');
            end if;
        end loop;
    end loop;
    
    for i in 1..trenutni_broj loop
        if mod(trenutni_broj,i) = 0 then
            dbms_output.put_line(i);
        end if;
    end loop;
end;
                
/*zad8:Prona�ite sve prim brojeve u rasponu od 116.000 do 117.000 (prim broj je broj koji je djeljiv samo sa 1 i sa samim sobom).
Na kraju ispi�ite ukupan broj prona�enih prim brojeva.*/

declare
    ukup_prim_broj number := 0;
begin
    for i in 116000..117000 loop
        if i/i=1 and i/1=i then
            ukup_prim_broj := ukup_prim_broj+i;
        end if;
    end loop;
    dbms_output.put_line(ukup_prim_broj);
end;

/*zad9:Za brojeve od 100 do 110 dohvatite potpuni zapis o zaposleniku s navedenim employee_id. 
Za svaki ispi�ite podatke employee_id, ime, prezime, broj telefona.*/

declare
    v_employee_id varchar2(25);
    v_first_name varchar2(25);
    v_last_name varchar2(25);
    v_phone_number varchar2(25);
begin
    for i in 100..110 loop
        select employee_id, first_name, last_name, phone_number
        into v_employee_id, v_first_name, v_last_name, v_phone_number
        from employees
        where employee_id=i;
        dbms_output.put_line(v_employee_id || ',' || v_first_name || ' ' || v_last_name || ',' || v_phone_number);
    end loop;
end;

/*zad10:Za brojeve od 95 do 105 dohvatite potpuni zapis o zaposleniku s navedenim employee_id. 
Za svaki ispi�ite podatke employee_id, ime, prezime, broj telefona. 
Ukoliko neki zaposlenik s navedenim ID ne postoji, potrebno je ispisati odgovaraju�u poruku i nastaviti izvr�avanje programa.*/

declare
    v_employee_id varchar2(25);
    v_first_name varchar2(25);
    v_last_name varchar2(25);
    v_phone_number varchar2(25);
begin
    for i in 95..105 loop
        if i<>v_employee_id then
            continue;
            dbms_output.put_line('Zaposlenik ne postoji sa' || i || 'ID-om.');
        end if;
        select employee_id, first_name, last_name, phone_number
        into v_employee_id, v_first_name, v_last_name, v_phone_number
        from employees
        where employee_id=i;
        dbms_output.put_line(v_employee_id || ',' || v_first_name || ' ' || v_last_name || ',' || v_phone_number);
    end loop;
end;

--LABOS11:

/*zad1:Napi�ite program koji za svaki department ra�una i ispisuje sljede�e podatke:
- ID i naziv odjela
- Broj zaposlenika koji rade u navedenom odjelu
- Prosje�nu pla�u u odjelu.*/

declare
    cursor c_dpt is
        select department_id, department_name, count(employee_id) emp_cnt, avg(salary) sal_avg
        from departments d inner join employees e on d.department_id=e.department_id
        group by department_id, department_name;
begin
    for r_dpt in c_dpt loop
            dbms_output.put_line(r_dpt.department_id||' '||r_dpt.department_name||' '||r_dpt.emp_cnt||' '||r_dpt.sal_avg);
    end loop;
end;

/*zad2:Napi�ite program koji za svaki department_id iz tablice departments dohva�a i ispisuje:
- ID i naziv odjela
- podatke o voditelju odjela ukoliko je unesen (ime, prezime i broj telefona iz employees tablice za managera - departments.manager_id),
- podatak o adresi i gradu u kojem je ured za navedeni odjel iz tablice locations.*/

declare
    cursor c_dpt is
        select department_id, department_name, first_name, last_name, phone_number, street_address, city
        from departments d left join employees e on d.manager_id=e.manager_id inner join locations l on d.location_id=l.location_id;
begin
    for r_dpt in c_dpt loop
            dbms_output.put_line(r_dpt.department_id||' '||r_dpt.department_name||' '||r_dpt.first_name||' '||r_dpt.last_name||' '||r_dpt.phone_number||' '||r_dpt.street_address||' '||r_dpt.city);
    end loop;
end;

/*zad3:Dohvatite sve podatke o zaposlenicima u associative array indeksiran po employee_id. 
Kori�tenjem metoda kolekcija dohvatite i ispi�ite koliko zapisa ima kolekcija, te koji je najmanji a koji najve�i iskori�teni indeks. 
Dodatno ispi�ite ime i prezime za employee_id = 210 ukoliko postoji.*/

declare
    type emp_type is table of employees%rowtype
                        index by binary_integer;
    emp_tab emp_type;
begin
   for c_emp in select * from employees loop
    emp_tab(r_emp.employee_id)  --???
end;

/*zad4:Kreirajte kolekciju u kojoj �ete u petlji zbrojiti pla�e zaposlenika po odjelima (samo po department_id iz tablice employees). 
Ispi�ite ukupnu pla�u za odjel 50 i ukupnu pla�u za zaposlenike za koje odjel nije definiran.*/


--

/*zad5:Ispisati grad s najve�om ukupnom pla�om i imena i prezimena i pla�e zaposlenika koji rade u tom gradu.*/
        

--



--LABOS12:

/*zad1:Napi�ite 3 funkcije DAY, MONTH i YEAR koje kao parametar primaju datum, a vra�aju integer koji odgovara danu, mjesecu odnosno godini 
za proslije�eni datum.*/

create or replace function DAY(d date)
    return int
is
begin
    return to_number(to_char(d, 'MM'));
end;
    
/*zad2:Napi�ite funkciju DATESERIAL koja kao parametre prima 3 integera: dan, mjesec i godinu, a vra�a datumsku vrijednost navedenog datuma.*/

create or replace function DATESERIAL(d int, m int, y int)
    return date
is
begin
    return to_date(d,m,y);
end;


/*zad3:Napi�ite funkciju koja vra�a prosje�nu pla�u za zadani deparment_id.*/

create or replace function avg_sal(dep_id departments.department_id%type) return number is
  v_avgsal employees.salary%type;
begin
  select avg(salary) into v_avgsal
  from employees 
  where department_id = dep_id;
  return v_avgsal;
end;

/*zad4:Kreirajte proceduru UPD_MANAGER_SAL koja za zadani department_id provjerava datum zaposlenja managera tog departmenta. 
Ukoliko je datum zaposlenja prije vi�e od 15 godina, potrebno je pove�ati pla�u manageru za 1000. 
Uputa: napravite tablicu EMPS kao kopiju tablice zaposlenika sa svim podacima. Iz procedure mijenjajte podatke u toj novoj tablici.
Nakon �to kreirate i kompajlirate provjerite pla�u za jednog managera i proceduru izvr�ite za taj department (exec) i provjerite da li se pla�a promijenila.
Nakon toga napravite ROLLBACK izmjena koje je napravila procedura.*/

create table EMPS as (select * from employees);

create or replace procedure UPD_MANAGER_SAL (p_dpt departments.department_ID%type)
is
    v_mng emps.employee_id%type;

begin
   for r in (select employee_id from emps
    where department_id = p_dpt)
    loop
        update emps
        set salary=salary+1000
        where employee_id = r.employee_id;
    end loop;
end;    


/*zad5:Kreirajte proceduru bez parametara UPD_ALLMGR_SAL koja za sve odjele s barem jednim zaposlenikom manageru pove�ava pla�u ukoliko je dovoljno dugo 
zaposlen (pozivom procedure iz prethodnog zadatka) i izvr�ite ju.*/

create or replace procedure UPD_ALLMGR_SAL
is
begin


/*zad6:Kreirajte upit kojim �ete dohvatiti department_id, department_name iz tablice departments, employee_id i hire_date managera departmenta, 
salary iz tablice employees i salary iz tablice emps. Neka upit dohvati sve zaposlenike (i one koji nisu voditelji nekog odjela). 
Provjerite da li vam je procedura dala o�ekivane rezultate. Napravite ROLLBACK nakon provjere u svakom slu�aju. 
Ukoliko je procedura u redu, izmijenite ju tako da dodate COMMIT naredbu na kraj procedure UPD_ALLMGR_SAL. 
Kompajirajte i izvr�ite proceduru, te jo� jednom provjerite stanje u bazi.*/

select department_id, department_name, employee_id, m.hire_date, e.salary, em.salary
from departments d left join employees e on d.department_id=e.department_id inner join emps em on e.employee_id=em.employee_id;

--LABOS13:(2.kolokvij)

/*zad1:Kreirati okida� koji �e u slu�aju a�uriranja JOB_ID u tablici EMPLOYEES zapisati odgovaraju�i zapis o dosada�njem zaposlenju u tablicu JOB_HISTORY.*/

create or replace trigger trig_job
after update of job_id on employees
for each row
begin
  insert into job_history (employee_id, start_date, end_date, job_id, department_id)
  values(:old.employee_id, :old.hire_date, sysdate, :old.job_id, :old.department_id);
end;

/*zad2:Kreirati proceduru koja kao parametar prima department_ID. Potrebno je ispisati naziv odjela (departments.department_name) 
i podatke o svim zaposlenicima unesenog odjela (employees.employee_ID, employees.first_name, employees.last_name). 
Ukoliko uneseni odjel ne postoji potrebno je ispisati adekvatnu poruku.*/

create or replace procedure dept_pro(dpt_id 
departments.department_id%type) is
v_depname departments.department_name%type;
cursor c_emp is select employee_id, first_name, last_name
                from employees 
                where department_id = dpt_id;
begin
  select department_name into v_depname from departments
  where department_id=dpt_id;
  dbms_output.put_line (v_depname);
  
  for r_emp in c_emp loop
    dbms_output.put_line (r_emp.employee_id ||' '||r_emp.first_name||' '||r_emp.last_name);
  end loop;
  
exception
    when no_data_found then
      dbms_output.put_line ('Uneseni odjel'||dpt_id||'ne postoji.');
end;

/*zad3:Kreirajte funkciju koja prima datumsku vrijednost i iz nje vra�a sat (0-23, tipa integer).*/

create or replace function SAT(date)
    return int
is
begin
    return to_number(to_char(date, 'hh24'));
end;

/*zad4:Napi�ite neimenovani blok u kojem se ispisuje nazive svih dr�ava (country_name) iz tablice COUNTRIES.*/

declare
    cursor c_cname is select country_name from countries;
begin
  for r_cname in c_cname loop
    dbms_output.put_line(r_cname.country_name);
  end loop;
end;

/*zad5:Kreirajte upit koji vra�a ime i prezime zaposlenika (employees.first_name, employees.last_name), te COMMISION_PCT ukoliko je naveden. 
Ukoliko COMMISSION_PCT nije upisan, umijesto NULL potrebno je vratiti 0.*/

select nvl(commission_pct, '0'), first_name, last_name
from employees; 



