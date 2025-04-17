# PHPStan livello 1 – Modulo AI

## Ultima correzione
- **File:** `config/config.php`
- **Problema:** Uso di `env()` fuori dal contesto consentito, segnalato da PHPStan/Larastan.
- **Soluzione:** Sostituito `env()` con `config()` per garantire compatibilità con la cache di configurazione di Laravel.

## Stato attuale
- Nessun errore bloccante a livello 1 su questo modulo.

---

[← Torna all'indice PHPStan nella root](../../../../docs/phpstan.md)
