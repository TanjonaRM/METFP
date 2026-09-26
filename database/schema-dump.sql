CREATE TABLE "admins" ("id" integer primary key autoincrement not null, "nom" varchar not null, "prenom" varchar not null, "email" varchar not null, "password" varchar not null, "role" varchar check ("role" in ('super_admin', 'admin', 'gestionnaire')) not null default 'admin', "avatar" varchar, "email_verified_at" datetime, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "deleted_at" datetime);

CREATE TABLE "affectations" ("id" integer primary key autoincrement not null, "formateur_id" integer not null, "filiere_id" integer not null, "etablissement_id" integer not null, "date_debut" date not null, "date_fin" date, "statut" varchar check ("statut" in ('actif', 'termine', 'suspendu')) not null default 'actif', "created_at" datetime, "updated_at" datetime, foreign key("formateur_id") references "formateurs"("id") on delete cascade, foreign key("filiere_id") references "filieres"("id") on delete cascade, foreign key("etablissement_id") references "etablissements"("id") on delete cascade);

CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

CREATE TABLE "etablissements" ("id" integer primary key autoincrement not null, "code" varchar not null, "nom" varchar not null, "type" varchar check ("type" in ('CFP', 'LTP', 'Lycee', 'Autre')) not null default 'CFP', "region" varchar, "adresse" varchar, "telephone" varchar, "email" varchar, "created_at" datetime, "updated_at" datetime);

CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" text not null, "queue" text not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

CREATE TABLE "filiere_options" ("id" integer primary key autoincrement not null, "filiere_id" integer not null, "libelle" varchar not null, "created_at" datetime, "updated_at" datetime, foreign key("filiere_id") references "filieres"("id") on delete cascade);

CREATE TABLE "filieres" ("id" integer primary key autoincrement not null, "code" varchar not null, "libelle" varchar not null, "niveau_id" integer not null, "secteur_id" integer not null, "description" text, "created_at" datetime, "updated_at" datetime, foreign key("niveau_id") references "niveaux"("id") on delete cascade, foreign key("secteur_id") references "secteurs"("id") on delete cascade);

CREATE TABLE "formateur_filieres" ("id" integer primary key autoincrement not null, "formateur_id" integer not null, "filiere_id" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("formateur_id") references "formateurs"("id") on delete cascade, foreign key("filiere_id") references "filieres"("id") on delete cascade);

CREATE TABLE "formateurs" ("id" integer primary key autoincrement not null, "matricule" varchar not null, "nom" varchar not null, "prenom" varchar not null, "sexe" varchar check ("sexe" in ('Masculin', 'Feminin')), "date_naissance" date, "lieu_naissance" varchar, "cin" varchar, "email" varchar not null, "telephone" varchar, "adresse" text, "fonction" varchar, "grade" varchar, "date_recrutement" date, "photo" varchar, "etablissement_id" integer, "statut" varchar check ("statut" in ('actif', 'inactif', 'en_attente')) not null default 'actif', "created_at" datetime, "updated_at" datetime, "deleted_at" datetime, foreign key("etablissement_id") references "etablissements"("id") on delete set null);

CREATE TABLE "formateurs_users" ("id" integer primary key autoincrement not null, "nom" varchar not null, "prenom" varchar not null, "email" varchar not null, "password" varchar not null, "matricule" varchar not null, "telephone" varchar, "etablissement_id" integer, "avatar" varchar, "statut" varchar check ("statut" in ('actif', 'inactif', 'en_attente')) not null default 'en_attente', "email_verified_at" datetime, "last_login_at" datetime, "remember_token" varchar, "created_at" datetime, "updated_at" datetime, "deleted_at" datetime);

CREATE TABLE "formations_sessions" ("id" integer primary key autoincrement not null, "code" varchar not null, "titre" varchar, "filiere_id" integer not null, "formateur_id" integer not null, "etablissement_id" integer not null, "date_debut" date not null, "date_fin" date not null, "nb_places" integer not null default '0', "description" text, "statut" varchar check ("statut" in ('active', 'terminee', 'annulee')) not null default 'active', "created_at" datetime, "updated_at" datetime, foreign key("filiere_id") references "filieres"("id") on delete cascade, foreign key("formateur_id") references "formateurs"("id") on delete cascade, foreign key("etablissement_id") references "etablissements"("id") on delete cascade);

CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

CREATE TABLE "niveaux" ("id" integer primary key autoincrement not null, "code" varchar not null, "libelle" varchar not null, "description" text, "created_at" datetime, "updated_at" datetime);

CREATE TABLE "notifications" ("id" integer primary key autoincrement not null, "user_id" integer, "titre" varchar not null, "message" text not null, "type" varchar check ("type" in ('info', 'success', 'warning', 'danger')) not null default 'info', "icone" varchar not null default 'notifications', "lu" tinyint(1) not null default '0', "lien" varchar, "data" text, "created_at" datetime, "updated_at" datetime, foreign key("user_id") references "admins"("id") on delete set null);

CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

CREATE TABLE "secteurs" ("id" integer primary key autoincrement not null, "code" varchar not null, "libelle" varchar not null, "created_at" datetime, "updated_at" datetime);

CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

CREATE TABLE sqlite_sequence(name,seq);

CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime);

CREATE UNIQUE INDEX "admins_email_unique" on "admins" ("email");

CREATE INDEX "cache_expiration_index" on "cache" ("expiration");

CREATE INDEX "cache_locks_expiration_index" on "cache_locks" ("expiration");

CREATE UNIQUE INDEX "etablissements_code_unique" on "etablissements" ("code");

CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs" ("uuid");

CREATE UNIQUE INDEX "filieres_code_unique" on "filieres" ("code");

CREATE UNIQUE INDEX "formateurs_email_unique" on "formateurs" ("email");

CREATE UNIQUE INDEX "formateurs_matricule_unique" on "formateurs" ("matricule");

CREATE UNIQUE INDEX "formateurs_users_email_unique" on "formateurs_users" ("email");

CREATE UNIQUE INDEX "formateurs_users_matricule_unique" on "formateurs_users" ("matricule");

CREATE UNIQUE INDEX "formations_sessions_code_unique" on "formations_sessions" ("code");

CREATE INDEX "idx_affectations_debut" on "affectations" ("date_debut");

CREATE INDEX "idx_affectations_etab" on "affectations" ("etablissement_id");

CREATE INDEX "idx_affectations_filiere" on "affectations" ("filiere_id");

CREATE INDEX "idx_affectations_formateur" on "affectations" ("formateur_id");

CREATE INDEX "idx_affectations_statut" on "affectations" ("statut");

CREATE INDEX "idx_etablissements_nom" on "etablissements" ("nom");

CREATE INDEX "idx_etablissements_type" on "etablissements" ("type");

CREATE INDEX "idx_filieres_libelle" on "filieres" ("libelle");

CREATE INDEX "idx_filieres_niveau" on "filieres" ("niveau_id");

CREATE INDEX "idx_filieres_secteur" on "filieres" ("secteur_id");

CREATE INDEX "idx_formateurs_etab" on "formateurs" ("etablissement_id");

CREATE INDEX "idx_formateurs_nom" on "formateurs" ("nom");

CREATE INDEX "idx_formateurs_prenom" on "formateurs" ("prenom");

CREATE INDEX "idx_formateurs_statut" on "formateurs" ("statut");

CREATE INDEX "idx_sessions_debut" on "formations_sessions" ("date_debut");

CREATE INDEX "idx_sessions_fin" on "formations_sessions" ("date_fin");

CREATE INDEX "idx_sessions_formateur" on "formations_sessions" ("formateur_id");

CREATE INDEX "idx_sessions_statut" on "formations_sessions" ("statut");

CREATE INDEX "jobs_queue_index" on "jobs" ("queue");

CREATE UNIQUE INDEX "niveaux_code_unique" on "niveaux" ("code");

CREATE INDEX "notifications_lu_created_at_index" on "notifications" ("lu", "created_at");

CREATE UNIQUE INDEX "secteurs_code_unique" on "secteurs" ("code");

CREATE INDEX "sessions_last_activity_index" on "sessions" ("last_activity");

CREATE INDEX "sessions_user_id_index" on "sessions" ("user_id");

CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");